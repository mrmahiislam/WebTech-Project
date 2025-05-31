<!-- terms.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Terms and Conditions</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f5f7fa;
      color: #333;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .terms-box {
      background: #fff;
      padding: 24px 30px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      max-width: 600px;
      width: 90%;
      text-align: center;
    }

    h1 {
      font-size: 24px;
      color: #2c3e50;
      margin-bottom: 10px;
    }

    p.updated {
      font-size: 13px;
      color: #7f8c8d;
      margin-bottom: 20px;
    }

    .terms-content {
      text-align: left;
      font-size: 14.5px;
      line-height: 1.5;
      margin-bottom: 20px;
    }

    .terms-content h2 {
      font-size: 16px;
      color: #3498db;
      margin-top: 15px;
      margin-bottom: 8px;
    }

    .accept-btn {
      background-color: #3498db;
      color: white;
      border: none;
      padding: 10px 24px;
      border-radius: 4px;
      font-size: 14px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .accept-btn:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>
  <div class="terms-box">
    <h1>Terms & Conditions</h1>
    <p class="updated">Last Updated: <?php echo date('F j, Y'); ?></p>

    <div class="terms-content">
      <h2>1. Use of Service</h2>
      <p>By accessing Air Index Quality, you accept our terms. If not, kindly do not use the service.</p>

      <h2>2. Account & Privacy</h2>
      <p>You’re responsible for your login credentials. We respect your privacy and use your data responsibly.</p>

      <h2>3. Content Ownership</h2>
      <p>All site content belongs to Air Index Quality. Unauthorized use is prohibited.</p>

      <h2>4. Changes</h2>
      <p>We may update or remove features without notice.</p>
    </div>

    <button class="accept-btn" onclick="acceptTerms()">I Accept & Close</button>
<script>
  function acceptTerms() {
    if (window.opener && !window.opener.closed) {
      const checkbox = window.opener.document.getElementById("terms");
      if (checkbox) {
        checkbox.checked = true;
      }
    }
    window.close();
  }
</script>

  </div>
</body>
</html>
