<?php
session_start();

// Ensure user is logged in
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
    exit();
}

// Dynamically read user-specific color cookie
$userEmail = $_SESSION['email'] ?? '';
$cookieKey = 'userColor_' . str_replace(['@', '.'], '_', $userEmail);
$backgroundColor = $_COOKIE[$cookieKey] ?? '#f5f5f5';

// Limit to max 10 cities
if (!isset($_POST['cities']) || !is_array($_POST['cities']) || count($_POST['cities']) === 0) {
    echo "
    <html>
    <head>
        <link rel='icon' href='images/AirIndex.png' type='image/png'>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #fff4f4;
                color: #c0392b;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .message-box {
                background-color: white;
                border: 2px solid #e74c3c;
                border-radius: 10px;
                padding: 30px 40px;
                text-align: center;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }
            .message-box h2 {
                margin-bottom: 10px;
                font-size: 22px;
            }
            .message-box p {
                font-size: 16px;
                color: #555;
            }
        </style>
    </head>
    <body>
        <div class='message-box'>
            <h2>No Cities Selected</h2>
            <p>Please select at least one city.<br>You will be redirected back in <span id='countdown'>3</span> seconds...</p>
        </div>
        <script>
            (function() {
                let count = 3;
                const countdownElement = document.getElementById('countdown');
                const timer = setInterval(function() {
                    count--;
                    countdownElement.textContent = count;
                    
                    if (count <= 0) {
                        clearInterval(timer);
                        window.location.href = 'request.php';
                    }
                }, 1000);
                
                // Fallback in case the interval fails
                setTimeout(function() {
                    clearInterval(timer);
                    window.location.href = 'request.php';
                }, 4000);
            })();
        </script>
    </body>
    </html>";
    exit();
}



// Connect to the database
$conn = new mysqli("localhost", "root", "", "registrationsignup");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute city AQI fetch query
$city_ids = $_POST['cities'];
$placeholders = implode(',', array_fill(0, count($city_ids), '?'));
$stmt = $conn->prepare("SELECT name, country, aqi, status FROM cities WHERE id IN ($placeholders)");

$types = str_repeat('i', count($city_ids));
$stmt->bind_param($types, ...$city_ids);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AQI Results - Air Index Quality</title>
    <link rel="icon" href="images/AirIndex.png" type="image/png">
    <style>
        :root {
            --good: #2ecc71;
            --moderate: #f1c40f;
            --usg: #e67e22;
            --unhealthy: #e74c3c;
            --very-unhealthy: #9b59b6;
            --hazardous: #7f8c8d;
            --background: <?= htmlspecialchars($backgroundColor); ?>;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--background);
            margin: 0;
            padding: 0;
        }

        .header {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            padding: 5px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 25px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 1.6em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
            font-weight: 600;
        }

        .button-group {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            padding: 0 40px;
        }

        .btn {
            text-decoration: none;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 30px;
            color: white;
            background-color: #3498db;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .logout-btn {
            background-color: #e74c3c;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        /* Status text colors only */
        .status-Good { color: #2ecc71; font-weight: bold; }
        .status-Moderate { color: #f1c40f; font-weight: bold; }
        .status-Unhealthy_for_Sensitive_Groups { color: #e67e22; font-weight: bold; }
        .status-Unhealthy { color: #e74c3c; font-weight: bold; }
        .status-Very_Unhealthy { color: #9b59b6; font-weight: bold; }
        .status-Hazardous { color: #7f8c8d; font-weight: bold; }

    </style>
</head>
<body>
    <div class="header">
        <h1>Air Index Quality Dashboard</h1>
    </div>

    <div class="container">
        <h2>Air Quality Index (AQI) of Selected Cities</h2>
        <table>
            <tr><th>City</th><th>Country</th><th>AQI</th><th>Status</th></tr>
            <?php while ($row = $result->fetch_assoc()): 
                $statusClass = 'status-' . str_replace(' ', '_', $row['status']);
            ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['country']) ?></td>
                    <td><?= htmlspecialchars($row['aqi']) ?></td>
                    <td class="<?= $statusClass ?>"><?= htmlspecialchars($row['status']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <div class="button-group">
            <a href="request.php" class="btn">← Back</a>
            <a href="logout.php" class="btn logout-btn">Logout</a>
        </div>
    </div>
</body>
</html>