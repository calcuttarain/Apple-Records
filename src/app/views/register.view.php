<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Include scriptul Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <h1>Register</h1>

    <?php if (!empty($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <form action="<?php echo ROOT; ?>/authentication/store" method="POST">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required>
        <br>
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
        <br>
        <label for="type">Account Type:</label>
        <select name="type" id="type">
            <option value="customer">Customer</option>
            <option value="band_member">Band Member</option>
            <option value="staff">Staff</option>
            <option value="admin">Admin</option>
        </select>
        <br>

        <!-- Google reCAPTCHA -->
        <div class="g-recaptcha" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>"></div>
        <br>

        <button type="submit">Register</button>
    </form>
</body>
</html>

