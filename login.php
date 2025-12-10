<?php
session_start();
include 'config.php';

if (isset($_POST['btnlogin'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass' LIMIT 1";
    $cek = $koneksi->query($sql);

    if ($cek && $cek->num_rows === 1) {
        $data = $cek->fetch_assoc();

        $_SESSION['users'] = $data['username'];
        $_SESSION['level'] = $data['level'];

        if ($data['level'] == 'admin') {
            header("Location: pages_admin/index.php"); exit();
        } else if ($data['level'] == 'ustadz') {
            header("Location: pages_ustadz/index.php"); exit();
        } else if ($data['level'] == 'santri') {
            header("Location: pages_santri/index.php"); exit();
        }

    } else {
        echo "<script>alert('Login gagal! Username atau password salah');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Santri Pro - Login</title>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            max-width: 450px;
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h3 {
            color: #667eea;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .login-header p {
            color: #666;
            font-size: 14px;
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .input-group-text {
            background: #f8f9fa;
            border-radius: 10px;
            border: 1px solid #ddd;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .form-check-label {
            font-size: 14px;
            color: #666;
        }
        .forgot-link {
            text-align: center;
            margin-top: 20px;
        }
        .forgot-link a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
        }
        .forgot-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="card login-card p-5 mx-auto">
        <div class="login-header">
            <i class="bi bi-mortarboard-fill" style="font-size: 3rem; color: #667eea;"></i>
            <h3>Santri Pro</h3>
            <p>Login to access your dashboard</p>
        </div>

        <form action="" method="post" autocomplete="off">
            <div class="input-group mb-4">
                <div class="form-floating flex-grow-1">
                    <input id="loginUser" type="text" name="user" class="form-control" placeholder=" " required />
                    <label for="loginUser">Username</label>
                </div>
                <span class="input-group-text"><i class="bi bi-person"></i></span>
            </div>

            <div class="input-group mb-4">
                <div class="form-floating flex-grow-1">
                    <input id="loginPassword" type="password" name="pass" class="form-control" placeholder=" " required />
                    <label for="loginPassword">Password</label>
                </div>
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            </div>

            <div class="row mb-4">
                <div class="col-8 d-flex align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault"> Remember Me </label>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" name="btnlogin" class="btn btn-primary w-100">
                        Sign In
                    </button>
                </div>
            </div>

            <div class="forgot-link">
                <a href="#">Forgot Password?</a>
            </div>
        </form>
    </div>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

