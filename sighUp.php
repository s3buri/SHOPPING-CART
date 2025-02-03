<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up - Shopping Cart</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
      }

      body {
        background: linear-gradient(45deg, #ff6b6b 0%, #ffb88c 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
      }

      .signup-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 500px;
      }

      .signup-header {
        background: linear-gradient(45deg, #ff6b6b 0%, #ffb88c 100%);
        padding: 30px;
        text-align: center;
        color: white;
      }

      .signup-header h1 {
        font-size: 2em;
        margin-bottom: 10px;
      }

      .signup-header p {
        opacity: 0.8;
      }

      .signup-form {
        padding: 30px;
      }

      .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
      }

      .form-group {
        flex: 1;
        position: relative;
      }

      .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #666;
        font-weight: 500;
      }

      .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #eee;
        border-radius: 8px;
        font-size: 1em;
        transition: border-color 0.3s ease;
      }

      .form-group input:focus {
        outline: none;
        border-color: #ff6b6b;
      }

      .error-message {
        color: #ff6b6b;
        font-size: 0.85em;
        margin-top: 5px;
        display: none;
      }

      .password-requirements {
        margin: 10px 0;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
      }

      .requirement {
        font-size: 0.85em;
        color: #666;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
      }

      .requirement.valid {
        color: #28a745;
      }

      .requirement::before {
        content: "•";
        color: #ccc;
      }

      .requirement.valid::before {
        content: "✓";
        color: #28a745;
      }

      .terms {
        margin: 20px 0;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        color: #666;
      }

      .terms input {
        margin-top: 4px;
      }

      .signup-button {
        width: 100%;
        padding: 12px;
        background: linear-gradient(45deg, #ff6b6b 0%, #ffb88c 100%);
        border: none;
        border-radius: 8px;
        color: white;
        font-size: 1em;
        cursor: pointer;
        transition: transform 0.3s ease;
      }

      .signup-button:hover {
        transform: translateY(-2px);
      }

      .login-link {
        text-align: center;
        margin-top: 20px;
        color: #666;
      }

      .login-link a {
        color: #ff6b6b;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
      }

      .login-link a:hover {
        color: #ff5252;
      }

      @media (max-width: 600px) {
        .form-row {
          flex-direction: column;
          gap: 0;
        }
      }
    </style>
  </head>
  <body>
  <?php include 'config.php'; ?>
    <div class="signup-container">
      <div class="signup-header">
        <h1>Create Account</h1>
        <p>Join our shopping community today</p>
      </div>

      <form
        class="signup-form"
        id="signupForm"
        onsubmit="return validateForm(event)"
      >
        <div class="form-row">
          <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="firstName" required />
            <div class="error-message" id="firstNameError"></div>
          </div>

          <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="lastName" required />
            <div class="error-message" id="lastNameError"></div>
          </div>
        </div>

        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" required />
          <div class="error-message" id="emailError"></div>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required />
          <div class="error-message" id="passwordError"></div>
        </div>

        <div class="password-requirements">
          <div class="requirement" id="lengthReq">
            At least 8 characters long
          </div>
          <div class="requirement" id="upperReq">Contains uppercase letter</div>
          <div class="requirement" id="lowerReq">Contains lowercase letter</div>
          <div class="requirement" id="numberReq">Contains number</div>
          <div class="requirement" id="specialReq">
            Contains special character
          </div>
        </div>

        <div class="form-group">
          <label for="confirmPassword">Confirm Password</label>
          <input
            type="password"
            id="confirmPassword"
            name="confirmPassword"
            required
          />
          <div class="error-message" id="confirmPasswordError"></div>
        </div>

        <!-- Add subject and message fields -->
        <div class="form-group">
          <label for="subject">Subject</label>
          <input type="text" id="subject" name="subject" required />
          <div class="error-message" id="subjectError"></div>
        </div>

        <div class="form-group">
          <label for="message">Message</label>
          <textarea id="message" name="message" required></textarea>
          <div class="error-message" id="messageError"></div>
        </div>

        <div class="terms">
          <input type="checkbox" id="terms" name="terms" required />
          <label for="terms">
            I agree to the Terms of Service and Privacy Policy
          </label>
        </div>

        <button type="submit" class="signup-button">Create Account</button>

        <div class="login-link">
          Already have an account? <a href="login.html">Login</a>
        </div>
      </form>
    </div>

    <script>
      function validateForm(event) {
        event.preventDefault();

        let isValid = true;
        const firstName = document.getElementById("firstName").value;
        const lastName = document.getElementById("lastName").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const confirmPassword =
          document.getElementById("confirmPassword").value;
        const subject = document.getElementById("subject").value;
        const message = document.getElementById("message").value;

        // Reset error messages
        document.querySelectorAll(".error-message").forEach((error) => {
          error.style.display = "none";
        });

        // Name validation
        if (firstName.length < 2) {
          document.getElementById("firstNameError").textContent =
            "First name is too short";
          document.getElementById("firstNameError").style.display = "block";
          isValid = false;
        }

        if (lastName.length < 2) {
          document.getElementById("lastNameError").textContent =
            "Last name is too short";
          document.getElementById("lastNameError").style.display = "block";
          isValid = false;
        }

        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
          document.getElementById("emailError").textContent =
            "Please enter a valid email address";
          document.getElementById("emailError").style.display = "block";
          isValid = false;
        }

        // Password validation
        if (!validatePassword(password)) {
          document.getElementById("passwordError").textContent =
            "Password does not meet requirements";
          document.getElementById("passwordError").style.display = "block";
          isValid = false;
        }

        if (password !== confirmPassword) {
          document.getElementById("confirmPasswordError").textContent =
            "Passwords do not match";
          document.getElementById("confirmPasswordError").style.display =
            "block";
          isValid = false;
        }

        // Subject validation
        if (subject.length < 1) {
          document.getElementById("subjectError").textContent =
            "Subject is required";
          document.getElementById("subjectError").style.display = "block";
          isValid = false;
        }

        // Message validation
        if (message.length < 1) {
          document.getElementById("messageError").textContent =
            "Message is required";
          document.getElementById("messageError").style.display = "block";
          isValid = false;
        }

        if (isValid) {
          alert("Account created successfully!");
          document.getElementById("signupForm").reset();
          resetRequirements();
        }

        return false;
      }

      function validatePassword(password) {
        const minLength = password.length >= 8;
        const hasUpper = /[A-Z]/.test(password);
        const hasLower = /[a-z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        const hasSpecial = /[!@#$%^&*]/.test(password);

        document
          .getElementById("lengthReq")
          .classList.toggle("valid", minLength);
        document.getElementById("upperReq").classList.toggle("valid", hasUpper);
        document.getElementById("lowerReq").classList.toggle("valid", hasLower);
        document
          .getElementById("numberReq")
          .classList.toggle("valid", hasNumber);
        document
          .getElementById("specialReq")
          .classList.toggle("valid", hasSpecial);

        return minLength && hasUpper && hasLower && hasNumber && hasSpecial;
      }

      function resetRequirements() {
        document.querySelectorAll(".requirement").forEach((req) => {
          req.classList.remove("valid");
        });
      }

      // Real-time password validation
      document
        .getElementById("password")
        .addEventListener("input", function () {
          validatePassword(this.value);
        });
    </script>
  </body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "s_cart";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($subject) || empty($message)) {
            echo "<script>alert('Please fill in all required fields.');</script>";
        } else {
            // Code to insert data into the database
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>
    