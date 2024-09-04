<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - K.M.A Log System</title>
    <link rel="icon" href="assets/img/logo_kma.png" type="image/x-icon" />

    <!-- Fonts and Icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins.min.css">
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: url('assets/img/building.jpg') no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        .login-container {
            position: relative;
            z-index: 2;
            width: 400px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-container img {
            height: 50px;
            margin: 0;
        }
        .title {
            font-weight: 700;
            font-size: 22px;
            margin-top: 10px;
            color: #2E3A59;
        }
        .subtitle {
            font-weight: 500;
            font-size: 16px;
            margin-bottom: 20px;
            color: #6861CE;
        }
        .login-form {
            margin-top: 20px;
        }
        .login-form .form-group {
            margin-bottom: 15px;
        }
        .login-form .btn {
            width: 100%;
            background-color: #6861CE;
            border: none;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
        }
        .login-form .btn:hover {
            background-color: #5750c3;
        }
        .add-employee-link {
            display: block;
            text-align: right;
            font-size: 12px;
            margin-top: 10px;
            color: #6861CE;
            text-decoration: none;
        }
        .add-employee-link:hover {
            text-decoration: underline;
        }
        .logos {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }
        .logos img {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="login-container">
        <div class="logos">
            <img src="assets/img/logo_kma.png" alt="KMA Logo">
            <img src="assets/img/coat_of.png" alt="Coat of Arms">
        </div>
        <div class="title">Kumasi Metropolitan Assembly</div>
        <div class="subtitle">Log System</div>
        <div class="login-form">
            <h5>Sign in to your account</h5>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn">Log In</button>
            </form>
            <a href="add_employee.php" class="add-employee-link">Add Employee</a>
        </div>
    </div>
</body>
</html>
