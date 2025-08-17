<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Modal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <button class="btn" id="btn">Login</button>

    <div class="modal" id="modal">
        <div class="top">
            <p>Login to Continue</p>
            <span id="closeModal" class="close">X</span>
        </div>

        <div class="main">
        <form method="POST" action="login_logic.php">
    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
</form>

            <div class="right">
                <h4>Not Our Member?</h4>
                <p>Have not previously registered?</p>
                <button class="btn" id="register">Register</button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>


