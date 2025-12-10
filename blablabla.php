<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pilih Jenis Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(135deg, #1E3A8A, #3B82F6);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-box {
            background: #ffffff;
            width: 90%;
            max-width: 650px;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            text-align: center;
            animation: fadeIn 0.6s ease;
        }
        .login-option {
            border-radius: 16px;
            padding: 25px;
            background: #f8f9ff;
            transition: 0.3s;
            cursor: pointer;
        }
        .login-option:hover {
            background: #eef2ff;
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }
        .icon-box {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #e8edff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #1E3A8A;
            margin: 0 auto 15px auto;
        }
        h4 { font-weight: 600; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px);} 
            to { opacity: 1; transform: translateY(0);} 
        }
        </style>
</head>

<body>
    <div class="login-box">
        <h2 class="mb-4 fw-bold">Pilih Jenis Login</h2>
        <p class="text-muted mb-4">Silakan pilih peran untuk masuk ke dashboard.</p>

        <div class="row g-4">
            <!-- Admin -->
            <div class="col-md-4">
                <a href="pages_admin/index.php" class="text-decoration-none text-dark">
                    <div class="login-option">
                        <div class="icon-box"><i class="bi bi-person-gear"></i></div>
                        <h4>Admin</h4>
                        <p class="text-muted small">Akses penuh sistem</p>
                    </div>
                </a>
            </div>

            <!-- Ustadz -->
            <div class="col-md-4">
                <a href="pages_ustadz/index.php" class="text-decoration-none text-dark">
                    <div class="login-option">
                        <div class="icon-box"><i class="bi bi-book-half"></i></div>
                        <h4>Ustadz</h4>
                        <p class="text-muted small">Mengelola data santri</p>
                    </div>
                </a>
            </div>

            <!-- Santri -->
            <div class="col-md-4">
                <a href="pages_santri/index.php" class="text-decoration-none text-dark">
                    <div class="login-option">
                        <div class="icon-box"><i class="bi bi-people"></i></div>
                        <h4>Santri</h4>
                        <p class="text-muted small">Melihat perkembangan belajar</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
