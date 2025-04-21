<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WatchE-Market</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="welcome-message">
            <h1>Welcome back!</h1>
            <p>Sign in to your WatchE-Market account</p>
        </div>

        <form id="loginForm">
            <div class="form-group">
                <input type="email" id="email" placeholder="Email address" required>
                <div class="error-message" id="email-error"></div>
            </div>

            <div class="form-group">
                <input type="password" id="password" placeholder="Password" required>
                <div class="error-message" id="password-error"></div>
            </div>

            <button type="submit" class="login-btn">Sign In</button>

            <div class="footer-links">
                <a href="forgot-password.html">Forgot password?</a>
                <span>•</span>
                <a href="signup.html">Create account</a>
            </div>
        </form>
    </div>

    <div class="success-modal" id="successModal">
        <div class="modal-content">
            <h2>Welcome back!</h2>
            <p>You've successfully logged in to your account.</p>
            <button id="continueBtn">Continue</button>
        </div>
    </div>

    <script src="../assets/js/login.js"></script>
</body>
</html>