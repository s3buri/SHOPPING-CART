<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modern Contact Us - Shopping Cart</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      }

      body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .contact-container {
        width: 100%;
        max-width: 900px;
        margin: 20px;
        display: flex;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
      }

      .contact-info {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 40px;
        width: 40%;
        color: white;
      }

      .contact-info h2 {
        margin-bottom: 20px;
        font-size: 28px;
      }

      .info-item {
        margin-bottom: 30px;
      }

      .info-item i {
        font-size: 20px;
        margin-right: 10px;
      }

      .contact-form {
        background: white;
        padding: 40px;
        width: 60%;
      }

      .form-header {
        margin-bottom: 30px;
      }

      .form-header h2 {
        color: #333;
        font-size: 28px;
        margin-bottom: 10px;
      }

      .form-header p {
        color: #666;
      }

      .form-group {
        margin-bottom: 25px;
        position: relative;
      }

      .form-group label {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        transition: all 0.3s ease;
        pointer-events: none;
      }

      .form-group.message label {
        top: 20px;
      }

      .form-group input,
      .form-group textarea {
        width: 100%;
        padding: 15px;
        border: 2px solid #eee;
        border-radius: 10px;
        font-size: 16px;
        transition: all 0.3s ease;
      }

      .form-group input:focus,
      .form-group textarea:focus {
        border-color: #667eea;
        outline: none;
      }

      .form-group input:focus + label,
      .form-group textarea:focus + label,
      .form-group input:valid + label,
      .form-group textarea:valid + label {
        top: -10px;
        left: 10px;
        background: white;
        padding: 0 5px;
        font-size: 12px;
        color: #667eea;
      }

      .form-group textarea {
        height: 150px;
        resize: none;
      }

      button {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 30px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
        transition: transform 0.3s ease;
      }

      button:hover {
        transform: translateY(-2px);
      }

      .message-box {
        padding: 15px;
        margin-top: 20px;
        border-radius: 10px;
        display: none;
        animation: slideIn 0.5s ease;
      }

      .success-message {
        background: #d4edda;
        color: #155724;
      }

      .error-message {
        background: #f8d7da;
        color: #721c24;
      }

      @keyframes slideIn {
        from {
          transform: translateY(-20px);
          opacity: 0;
        }
        to {
          transform: translateY(0);
          opacity: 1;
        }
      }

      @media (max-width: 768px) {
        .contact-container {
          flex-direction: column;
        }
        .contact-info,
        .contact-form {
          width: 100%;
        }
      }
    </style>
  </head>
  <body>
    <div class="contact-container">
      <div class="contact-info">
        <h2>Contact Information</h2>
        <div class="info-item">
          <i>📍</i>
          <p>123 Shopping Street, Jimma City, ST 12345</p>
        </div>
        <div class="info-item">
          <i>📧</i>
          <p>contact@shoppingcart.com</p>
        </div>
        <div class="info-item">
          <i>📞</i>
          <p>+25196572642</p>
        </div>
      </div>

      <div class="contact-form">
        <div class="form-header">
          <h2>Send us a message</h2>
          <p>Have any questions? We'd love to hear from you.</p>
        </div>

        <form id="contactForm">
          <div class="form-group">
            <input type="text" id="name" required />
            <label for="name">Full Name</label>
          </div>

          <div class="form-group">
            <input type="email" id="email" required />
            <label for="email">Email Address</label>
          </div>

          <div class="form-group">
            <input type="text" id="subject" required />
            <label for="subject">Subject</label>
          </div>

          <div class="form-group message">
            <textarea id="message" required></textarea>
            <label for="message">Your Message</label>
          </div>

          <button type="submit">Send Message</button>
        </form>

        <div id="successMessage" class="message-box success-message">
          Thank you! Your message has been sent successfully.
        </div>
        <div id="errorMessage" class="message-box error-message">
          Oops! Something went wrong. Please try again.
        </div>
      </div>
    </div>

    <script>
      document
        .getElementById("contactForm")
        .addEventListener("submit", function (e) {
          e.preventDefault();

          const name = document.getElementById("name").value;
          const email = document.getElementById("email").value;
          const subject = document.getElementById("subject").value;
          const message = document.getElementById("message").value;

          if (!name || !email || !subject || !message) {
            showMessage("error", "Please fill in all fields");
            return;
          }

          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailRegex.test(email)) {
            showMessage("error", "Please enter a valid email address");
            return;
          }

          // Simulate form submission
          setTimeout(() => {
            this.reset();
            showMessage(
              "success",
              "Thank you! Your message has been sent successfully."
            );
          }, 1000);
        });

      function showMessage(type, message) {
        const successMessage = document.getElementById("successMessage");
        const errorMessage = document.getElementById("errorMessage");

        if (type === "success") {
          successMessage.textContent = message;
          successMessage.style.display = "block";
          errorMessage.style.display = "none";

          setTimeout(() => {
            successMessage.style.display = "none";
          }, 5000);
        } else {
          errorMessage.textContent = message;
          errorMessage.style.display = "block";
          successMessage.style.display = "none";

          setTimeout(() => {
            errorMessage.style.display = "none";
          }, 5000);
        }
      }

      // Floating label animation
      const inputs = document.querySelectorAll("input, textarea");
      inputs.forEach((input) => {
        input.addEventListener("focus", function () {
          this.parentElement.classList.add("focused");
        });

        input.addEventListener("blur", function () {
          if (!this.value) {
            this.parentElement.classList.remove("focused");
          }
        });
      });
    </script>
  </body>
</html>
