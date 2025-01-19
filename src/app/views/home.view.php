<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        img {
            width: 300px;
            margin-bottom: 20px;
        }
        .buttons {
            margin-top: 20px;
        }
        .buttons a {
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 5px;
            font-size: 16px;
        }
        .buttons a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>This is the almighty home view page</h1>

    <img src="<?= ROOT ?>/assets/images/apple.jpg" alt="Apple Image">

    <div class="buttons">
        <a href="<?= ROOT ?>/authentication/register">Register</a>
        <a href="<?= ROOT ?>/authentication/login">Login</a>
    </div>
</body>
</html>

