<?php
// process.php - MUST be first line of file

// Start with session destruction if canceling
if (isset($_GET['action']) && $_GET['action'] === 'cancel') {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION = [];
    session_destroy();

    $params = session_get_cookie_params();
    setcookie(session_name(), '', [
        'expires' => time() - 3600,
        'path' => $params['path'],
        'domain' => $params['domain'],
        'secure' => $params['secure'],
        'httponly' => $params['httponly'],
        'samesite' => $params['samesite'] ?? 'Lax'
    ]);

    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
    header("Location: SignUp.php");
    exit;
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'registrationsignup';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = '';
$success = false;
$show_success = false;

if (isset($_POST['login_email']) && isset($_POST['login_password'])) {
    header('Content-Type: application/json');
    
    $email = trim($conn->real_escape_string($_POST['login_email']));
    $password = $_POST['login_password'];
    
    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'error' => 'Please fill in all fields.']);
        exit();
    }

    // Validate email format
    if (!preg_match('/^\d{2}-\d{5}-\d@student\.aiub\.edu$/', $email)) {
        echo json_encode(['success' => false, 'error' => 'Invalid email format.']);
        exit();
    }

    $stmt = $conn->prepare("SELECT ID, FullName, Password FROM registration WHERE Email = ?");
    if (!$stmt) {
        echo json_encode(['success' => false, 'error' => 'Database error. Please try again.']);
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $stmt->close();
        echo json_encode(['success' => false, 'error' => 'Invalid email.']);
        exit();
    }

    $row = $result->fetch_assoc();
    $hashed_password = $row['Password'];

    if (!password_verify($password, $hashed_password)) {
        $stmt->close();
        echo json_encode(['success' => false, 'error' => 'Incorrect password.']);
        exit();
    }

    $stmt->close();
    session_regenerate_id(true);
    $_SESSION['email'] = $email;
    $_SESSION['loggedin'] = true;
    $_SESSION['fullname'] = $row['FullName'];

    echo json_encode(['success' => true]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm'])) {
        $formData = $_SESSION['form_data'] ?? [];
        $dob = $formData['DOB'] ?? null;
        $age = 0;
        if ($dob) {
            $dobDate = DateTime::createFromFormat('Y-m-d', $dob);
            if ($dobDate) {
                $today = new DateTime('today');
                $age = $dobDate->diff($today)->y;
            }
        }
        $formData['Age'] = $age;

        try {
            $hashed_password = password_hash($formData['Password'], PASSWORD_DEFAULT);

            $check = $conn->prepare("SELECT ID FROM registration WHERE Email = ?");
            if (!$check) {
                throw new Exception("Database error: failed to prepare check statement.");
            }
            $check->bind_param("s", $formData['Email']);
            $check->execute();
            $checkResult = $check->get_result();

            if ($checkResult && $checkResult->num_rows > 0) {
                $check->close();
                throw new Exception("This email is already registered.");
            }
            $check->close();

            $stmt = $conn->prepare("INSERT INTO registration 
                (FullName, Email, Password, Age, ZipCode, PreferredCity) 
                VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssiss",
                $formData['FullName'],
                $formData['Email'],
                $hashed_password,
                $formData['Age'],
                $formData['ZipCode'],
                $formData['PreferredCity']
            );

            if ($stmt->execute()) {
                $success = true;
                $show_success = true;

                $cookieName = 'userColor_' . str_replace(['@', '.'], '_', $formData['Email']);
                setcookie($cookieName, $formData['Color'], time() + (86400 * 30), "/");

                $_SESSION['user_email'] = $formData['Email'];
                unset($_SESSION['form_data']);
            }
            $stmt->close();
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    } elseif (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['password'])) {
        $dob = $_POST['age'] ?? null;
        $age = 0;
        if ($dob) {
            $dobDate = DateTime::createFromFormat('Y-m-d', $dob);
            if ($dobDate) {
                $today = new DateTime('today');
                $age = $dobDate->diff($today)->y;
            }
        }

        $formData = [
            'FullName' => $conn->real_escape_string($_POST['fullname'] ?? ''),
            'Email' => $conn->real_escape_string($_POST['email'] ?? ''),
            'Password' => $_POST['password'] ?? '',
            'Age' => $age,
            'DOB' => $dob,
            'ZipCode' => $conn->real_escape_string($_POST['zipcode'] ?? ''),
            'PreferredCity' => $conn->real_escape_string($_POST['city'] ?? ''),
            'Color' => $_POST['favcolor'] ?? '#ffffff',
            'Terms' => isset($_POST['terms']) ? 1 : 0
        ];

        $_SESSION['form_data'] = $formData;

        header("Location: process.php");
        exit;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Your Registration</title>
    <link rel="icon" href="images/AirIndex.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 700px;
            width: 90%;
            background: white;
            padding: 3rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            font-size: 1.1rem;
        }
        h2 {
            color: #333;
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 2rem;
        }
        .review-data {
            margin: 1.5rem 0;
        }
        .review-data .data-row {
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .color-preview {
    display: inline-block;
    width: 20px;
    height: 20px;
    margin-left: 10px;
    border: 1px solid #ccc;
    vertical-align: middle;
}
        .buttons {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        .btn {
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-confirm {
            background-color: #4CAF50;
            color: white;
            padding: 1rem 1.2rem;
            font-size: 1.2rem;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            line-height: 1;
        }
        .btn-cancel {
            background-color: #f44336;
            color: white;
            padding: 1rem 1.2rem;
            font-size: 1.25rem;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            line-height: 1;
            text-decoration: none;
        }
        .error-message,
        .success-message {
            text-align: center;
            font-size: 1.6rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }
        .error-message {
            color: red;
        }
        .success-message {
            color: green;
        }
    </style>
</head>
<body>
<div class="container">
    <?php if ($show_success): ?>
        <div class="success-message">Registration successful!</div>
        <p style="text-align: center; font-size: 1.2rem;">
        You will be redirected in <span id="countdown">3</span> seconds...
    </p>
 <script>
        (function() {
            let count = 3;
            const countdownElement = document.getElementById('countdown');
            const timer = setInterval(function() {
                count--;
                countdownElement.textContent = count;
                
                if (count <= 0) {
                    clearInterval(timer);
                    window.location.href = "SignUp.php";
                }
            }, 1000);
            
            // Fallback in case the interval fails
            setTimeout(function() {
                clearInterval(timer);
                window.location.href = "SignUp.php";
            }, 4000); // 1 second longer than needed
        })();
    </script>

    <?php elseif (!empty($error)): ?>
        <div class="error-message">Registration Failed</div>
        <p style="text-align: center; font-size: 1.2rem;">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php else: ?>
        <h2>Review Your Information</h2>
        <?php $formData = $_SESSION['form_data'] ?? []; ?>
      <div class="review-data">
    <div class="data-row"><strong>Full Name:</strong> <?= htmlspecialchars($formData['FullName'] ?? '') ?></div>
    <div class="data-row"><strong>Email:</strong> <?= htmlspecialchars($formData['Email'] ?? '') ?></div>
    <div class="data-row"><strong>Age:</strong> <?= htmlspecialchars($formData['Age'] ?? '') ?></div>
    <div class="data-row"><strong>Zip Code:</strong> <?= htmlspecialchars($formData['ZipCode'] ?? '') ?></div>
    <div class="data-row"><strong>City:</strong> <?= ucfirst(htmlspecialchars($formData['PreferredCity'] ?? '')) ?></div>
    <div class="data-row"><strong>Preferred Color:</strong> 
        <?= htmlspecialchars($formData['Color'] ?? '#ffffff') ?>
        <span class="color-preview" style="background-color: <?= htmlspecialchars($formData['Color'] ?? '#ffffff') ?>"></span>
    </div>
</div>
        <div class="buttons">
            <form method="post">
                <input type="hidden" name="confirm" value="1">
                <button type="submit" class="btn-confirm">Confirm</button>
            </form>
            <a href="process.php?action=cancel" class="btn-cancel">Cancel</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
