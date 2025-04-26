<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Air Index Quality</title>
  <link rel="icon" type="image/x-icon" href="images/favicon.png">
  <style>
    * {
      box-sizing: border-box;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    body {
      background-color: #fafafa;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .header {
    display: flex;
    align-items: center;
    padding: 20px;
    justify-content: space-between;
    position: relative;
    width: 100%;
    background-color: #5578a7; 
    color: white; 
    box-shadow: 0 2px 5px rgba(0,0,0,0.1); 
  }
  

    .header h1 {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      text-align: center;
      width: max-content;
    }

    .header img {
      margin-left: auto;
    }

    .container {
      display: flex;
      flex-direction: column;
      width: 100%;
      max-width: 1600px;
      margin: 0 auto;
    }

    .row {
      display: flex;
      width: 100%;
    }

    .column {
      display: flex;
      flex-direction: column;
      flex: 1;
    }

    .box {
      border: 1px solid black;
      width: 100%;
      height: 500px;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: white;
    }

    .box3 {
        height: 600px;
        display: flex;
        justify-content: center; /* Centers horizontally */
        align-items: center; /* Centers vertically */
        background-color: #c7d8e2;
        padding: 10px;
    }

    .box4 {
      height: 400px;
    }

    .form-container {
      background-color: rgb(0, 0, 0);
      border: 1px solid #dbdbdb;
      padding: 20px;
      width: 100%;
      max-width: 380px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    h2 {
      text-align: center;
      font-weight: 600;
      margin-bottom: 15px;
      color: #ffffff;
      font-size: 22px;
    }

    .input-group {
      position: relative;
      margin-bottom: 10px;
    }

    input, select {
      width: 100%;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #dbdbdb;
      border-radius: 4px;
      background-color: #fafafa;
    }

    input:focus, select:focus {
      outline: none;
      border-color: #a8a8a8;
    }

    .show-password {
      position: absolute;
      right: 8px;
      top: 10px;
      background: none;
      border: none;
      cursor: pointer;
      color: #666;
      font-size: 12px;
    }

    .submit-button {
      padding: 10px;
      background-color: #0095f6;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 4px;
      width: 100%;
      cursor: pointer;
      font-size: 15px;
      margin-top: 5px;
    }

    .submit-button:hover {
      background-color: #007bd1;
    }

    .error {
      color: red;
      font-size: 12px;
      text-align: center;
      margin: 5px 0;
      min-height: 18px;
    }

    .terms-container {
      display: flex;
      align-items: center;
      margin: 8px 0;
    }

    .terms-label {
      margin-left: 6px;
      font-size: 12px;
    }

    .terms-link {
      color: #0095f6;
      text-decoration: none;
      cursor: pointer;
    }

    .terms-link:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .header {
        flex-direction: row;
        justify-content: center;
        flex-wrap: wrap;
        gap: 15px;
      }
      
      .header h1 {
        position: static;
        transform: none;
        order: 1;
        width: 100%;
        font-size: 24px;
      }
      
      .header img {
        order: 2;
        margin-left: 0;
        height: 60px;
        width: 80px;
      }
      
      .row {
        flex-direction: column;
      }
      
      .form-container {
        padding: 15px;
      }
      
      .box, .box4 {
        height: auto;
        min-height: 250px;
      }
      
      .box3 {
        height: auto;
        min-height: 450px;
        padding: 5px;
      }
      
      h2 {
        font-size: 20px;
        margin-bottom: 12px;
      }

      .logo {
        height: 60px; /* Adjust as needed */
        width: auto; /* Maintain aspect ratio */
        margin-right: 20px; /* Space between logo and text */
    }
      
      input, select {
        padding: 8px;
        font-size: 13px;
      }
    }
  </style>
</head>
<body>
  <div class="header">
    <h1>Air Index Quality</h1>
    <img src="images/AirIndex.png" alt="icon" height="50px" width="50px">
  </div>

  <div class="container">
    <div class="row">
      <div class="column">
        <div class="box">Box 1</div>
        <div class="box">Box 2</div>
      </div>
      <div class="column">
        <div class="box box3">
          <!-- Registration Form -->
          <div class="form-container">
            <form id="registrationForm">
              <h2>Sign up to Air Index</h2>

              <div class="input-group">
                <input type="text" id="email" name="email" placeholder="Email" required>
              </div>
              
              <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="button" class="show-password" onclick="togglePassword('password')">Show</button>
              </div>
              
              <div class="input-group">
                <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required>
                <button type="button" class="show-password" onclick="togglePassword('confirmpassword')">Show</button>
              </div>
              
              <div class="input-group">
                <input type="number" id="age" name="age" placeholder="Age" required>
              </div>
              
              <div class="input-group">
                <input type="text" id="zipcode" name="zipcode" placeholder="Zip Code" required>
              </div>

              <div class="input-group">
                <select name="city" id="city" required>
                  <option value="">Preferred City</option>
                  <option value="dhaka">Dhaka</option>
                  <option value="rajshahi">Rajshahi</option>
                  <option value="chittagong">Chittagong</option>
                  <option value="khulna">Khulna</option>
                  <option value="rangpur">Rangpur</option>
                  <option value="mymensingh">Mymensingh</option>
                  <option value="barisal">Barisal</option>
                  <option value="sylhet">Sylhet</option>
                </select>
              </div>

              <div class="terms-container">
                <input type="checkbox" name="terms" id="terms" style="width: 14px; height: 14px;">
                <label for="terms" class="terms-label">
                  <span style="color: white;">Accept</span> <a href="#" class="terms-link" onclick="showTerms()">Terms and Conditions</a>
                </label>
              </div>

              <div id="errorMsg" class="error"></div>

              <button type="submit" class="submit-button" onclick="return validateForm()">Sign Up</button>
            </form>
          </div>
        </div>
        <div class="box box4">Box 4</div>
      </div>
    </div>
  </div>

  <script>
    function validateForm() {
      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value.trim();
      const confirmPassword = document.getElementById("confirmpassword").value.trim();
      const age = document.getElementById("age").value.trim();
      const zipCode = document.getElementById("zipcode").value.trim();
      const city = document.getElementById("city").value;
      const termsChecked = document.getElementById("terms").checked;
      const errorMsg = document.getElementById("errorMsg");

      errorMsg.innerHTML = ""; // clear previous errors

      // Check for empty fields
      if (!email || !password || !confirmPassword || !age || !zipCode || !city) {
        errorMsg.innerHTML = "All fields are required.";
        return false;
      }

      // Email format validation
      const emailPattern = /^\d{2}-\d{5}-\d@student\.aiub\.edu$/;
      if (!emailPattern.test(email)) {
        errorMsg.innerHTML = "Email must be in format xx-xxxxx-x@student.aiub.edu";
        return false;
      }

      // Password length
      if (password.length < 8) {
        errorMsg.innerHTML = "Password must be at least 8 characters.";
        return false;
      }

      // Password match
      if (password !== confirmPassword) {
        errorMsg.innerHTML = "Passwords do not match.";
        return false;
      }

      // Age validation
      const ageNum = parseInt(age);
      if (isNaN(ageNum) || ageNum < 15) {
        errorMsg.innerHTML = "Age must be 15 or older.";
        return false;
      }

      // Zip Code validation
      if (!/^\d{4}$/.test(zipCode)) {
        errorMsg.innerHTML = "Zip Code must be exactly 4 digits.";
        return false;
      }

      // Terms and conditions
      if (!termsChecked) {
        errorMsg.innerHTML = "Please accept the Terms and Conditions.";
        return false;
      }

      alert("Form submitted successfully!");
      return true;
    }

    function togglePassword(fieldId) {
      const passwordField = document.getElementById(fieldId);
      const button = document.querySelector(`#${fieldId} + .show-password`);
      
      if (passwordField.type === "password") {
        passwordField.type = "text";
        button.textContent = "Hide";
      } else {
        passwordField.type = "password";
        button.textContent = "Show";
      }
    }

    function showTerms() {
  event.preventDefault();
  // Open in new tab/window with responsive design
  const termsWindow = window.open("", "TermsAndConditions", 
    "width=" + screen.width + ",height=" + screen.height + ",scrollbars=yes,resizable=yes");
  
  termsWindow.document.write(`
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Terms and Conditions</title>
      <style>
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        
        body {
          background-color: #f5f7fa;
          color: #333;
          line-height: 1.6;
        }
        
        .terms-wrapper {
          max-width: 1000px;
          margin: 0 auto;
          padding: 2rem;
          min-height: 100vh;
        }
        
        .terms-header {
          text-align: center;
          margin-bottom: 2rem;
          padding-bottom: 1rem;
          border-bottom: 2px solid #3498db;
        }
        
        .terms-header h1 {
          color: #2c3e50;
          font-size: 2.5rem;
          margin-bottom: 0.5rem;
        }
        
        .terms-header p {
          color: #7f8c8d;
          font-size: 1.1rem;
        }
        
        .terms-content {
          background: white;
          border-radius: 8px;
          box-shadow: 0 5px 15px rgba(0,0,0,0.05);
          padding: 2rem;
          margin-bottom: 2rem;
        }
        
        .terms-section {
          margin-bottom: 2rem;
        }
        
        .terms-section h2 {
          color: #3498db;
          font-size: 1.5rem;
          margin-bottom: 1rem;
          padding-bottom: 0.5rem;
          border-bottom: 1px solid #eee;
        }
        
        .terms-section p {
          margin-bottom: 1rem;
          font-size: 1.05rem;
        }
        
        .terms-footer {
          text-align: center;
          margin-top: 2rem;
        }
        
        .accept-btn {
          background-color: #3498db;
          color: white;
          border: none;
          padding: 12px 30px;
          font-size: 1rem;
          border-radius: 4px;
          cursor: pointer;
          transition: all 0.3s ease;
          box-shadow: 0 2px 10px rgba(52,152,219,0.3);
        }
        
        .accept-btn:hover {
          background-color: #2980b9;
          transform: translateY(-2px);
          box-shadow: 0 4px 15px rgba(52,152,219,0.4);
        }
        
        @media (max-width: 768px) {
          .terms-wrapper {
            padding: 1rem;
          }
          
          .terms-header h1 {
            font-size: 2rem;
          }
          
          .terms-content {
            padding: 1.5rem;
          }
        }
      </style>
    </head>
    <body>
      <div class="terms-wrapper">
        <header class="terms-header">
          <h1>Terms and Conditions</h1>
          <p>Last Updated: ${new Date().toLocaleDateString()}</p>
        </header>
        
        <main class="terms-content">
          <section class="terms-section">
            <h2>1. Acceptance of Terms</h2>
            <p>By using Air Index Quality, you agree to comply with these terms. If you disagree, please refrain from using our services.</p>
          </section>
          
          <section class="terms-section">
            <h2>2. Account Responsibilities</h2>
            <p>You are responsible for maintaining the confidentiality of your account credentials and all activities under your account.</p>
          </section>
          
          <section class="terms-section">
            <h2>3. Data Privacy</h2>
            <p>We collect and process personal data in accordance with our Privacy Policy. By using our services, you consent to this processing.</p>
          </section>
          
          <section class="terms-section">
            <h2>4. Service Modifications</h2>
            <p>We reserve the right to modify or discontinue any service feature without prior notice.</p>
          </section>
          
          <section class="terms-section">
            <h2>5. Intellectual Property</h2>
            <p>All content and trademarks are the property of Air Index Quality and protected by intellectual property laws.</p>
          </section>
        </main>
        
        <footer class="terms-footer">
          <button class="accept-btn" onclick="window.close()">I Accept & Close</button>
        </footer>
      </div>
    </body>
    </html>
  `);
  termsWindow.document.close();
  
  // Focus the new window
  termsWindow.focus();
}
      
    
  </script>
</body>
</html>
