<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoursePulse - Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #c2e59c, #64b3f4);
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background-color: #333;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            color: white;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .navbar a:hover {
            color: #17a2b8;
            transform: translateY(-2px);
        }

        #login-form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            margin-top: 50px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s ease;
        }

        #login-form:hover {
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            font-weight: bold;
            font-size: 16px;
            color: #6c757d;
            pointer-events: none;
            transition: top 0.3s, font-size 0.3s, color 0.3s;
        }

        .form-control {
            width: calc(100% - 20px);
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease;
            font-size: 16px;
            padding-top: 18px;
        }

        .form-control:focus {
            border-color: #6c63ff;
        }

        .form-control:focus+.form-label,
        .form-control:not(:placeholder-shown)+.form-label {
            top: 8px;
            font-size: 12px;
            color: #6c63ff;
        }

        .form-control:focus+.form-label,
        .form-control:not(:placeholder-shown)+.form-label,
        .form-label.click-hide {
            display: none;
        }

        #login-button {
            background-color: #6c63ff;
            border: none;
            padding: 15px 25px;
            font-size: 18px;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
        }

        #login-button:hover {
            background-color: #574dcf;
            transform: scale(1.05);
            box-shadow: 0px 0px 15px rgba(108, 99, 255, 0.4);
        }

        #signup-button {
            text-decoration: none;
        }

        .navbar-nav {
            margin: 0 auto;
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            font-size: 1.2rem;
            font-weight: bold;
            letter-spacing: 1px;
        }

        
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">CSE-Core</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_login.php">Admin Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container text-center">
        <h1 class="display-4 mt-4">Welcome to our platform</h1>
        <p class="lead">Discover a world of knowledge with our wide range of online courses.</p>
    </div>

    <div class="container" id="login-form">
        <form class="user" method="post" action="login_process.php">
            <div class="form-group">
                <label class="form-label" for="emailOrMobile" id="emailOrMobileLabel">Enter Email or Mobile:</label>
                <input class="form-control" type="text" name="emailOrMobile" id="emailOrMobile" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="password" id="passwordLabel">Password:</label>
                <input class="form-control" type="password" name="password" id="password" required>
            </div>
            <button id="login-button" type="submit" class="btn btn-primary btn-lg">Login</button>
        </form>
        <p class="mt-3">Not registered? <a id="signup-button" href="signup.php">Sign up here</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('emailOrMobile').addEventListener('focus', function () {
            document.getElementById('emailOrMobileLabel').classList.add('click-hide');
        });

        document.getElementById('password').addEventListener('focus', function () {
            document.getElementById('passwordLabel').classList.add('click-hide');
        });

        document.getElementById('emailOrMobile').addEventListener('blur', function () {
            if (this.value === '') {
                document.getElementById('emailOrMobileLabel').classList.remove('click-hide');
            }
        });

        document.getElementById('password').addEventListener('blur', function () {
            if (this.value === '') {
                document.getElementById('passwordLabel').classList.remove('click-hide');
            }
        });
    </script>
</body>

</html>
