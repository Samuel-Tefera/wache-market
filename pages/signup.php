<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Wache-Market</title>
    <link rel="stylesheet" href="../assets/css/signup.css">
</head>
<body>
    <div class="signup-container">
        <div class="signup-header">
            <h1>Create Your Account</h1>
            <p>Join Wache-Market to buy and sell on campus</p>
        </div>
        <form id="signupForm" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group">
                    <label for="firstName">First Name*</label>
                    <input name="firstName" type="text" id="firstName" required>
                    <div class="error-message" id="firstName-error"></div>
                </div>

                <div class="form-group">
                    <label for="lastName">Last Name*</label>
                    <input name="lastName" type="text" id="lastName" required>
                    <div class="error-message" id="lastName-error"></div>
                </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                  <label for="email">Email*</label>
                  <input name="email" type="email" id="email" required>
                  <div class="error-message" id="email-error"></div>
              </div>

              <div class="form-group">
                  <label for="phone">Phone Number</label>
                  <input name="phone" type="telphone" id="phone" placeholder="+251 243 697 011">
                  <div class="error-message" id="phone-error"></div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="password">Password*</label>
                <input name="password" type="password" id="password" required>
                <div class="error-message" id="password-error"></div>
              </div>

              <div class="form-group">
                  <label for="confirmPassword">Confirm Password*</label>
                  <input type="password" id="confirmPassword" required>
                  <div class="error-message" id="confirmPassword-error"></div>
              </div>
            </div>

            <div class="form-group-row">
                <div>
                  <label>I want to join as*</label>
                </div>
                <div class="mode-selector">
                    <label class="mode-option">
                        <input type="radio" name="mode" value="buyer" checked>
                        <span>Buyer</span>
                    </label>
                    <label class="mode-option">
                        <input type="radio" name="mode" value="seller">
                        <span>Seller</span>
                    </label>
                </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                  <label for="address">Address (Block & Dorm Number)</label>
                  <input name="address" type="text" id="address" placeholder="e.g., Block A, Dorm 205">
              </div>

              <div class="form-group">
                  <label for="profileImage">Profile Picture (Optional)</label>
                  <input name="profile" type="file" id="profileImage" accept="image/*">
                  <div class="error-message" id="profileImage-error"></div>
              </div>
            </div>

            <button type="submit" class="signup-btn">Create Account</button>

            <div class="login-link">
                Already have an account? <a href="login.html">Log in</a>
            </div>
        </form>
    </div>

    <script src="../assets/js/signup.js"></script>
</body>
</html>