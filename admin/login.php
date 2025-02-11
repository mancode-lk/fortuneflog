<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fortune Flog | Admin Portal</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #2b1b0f 0%, #4a3221 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 450px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .brand-logo {
            height: 80px;
            margin-bottom: 1rem;
        }

        .brand-title {
            font-family: 'Playfair Display', serif;
            color: #d4af37;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #d4af37;
            font-size: 1.2rem;
        }

        .form-control {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #d4af37;
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.2);
        }

        .auth-btn {
            background: #d4af37;
            color: #2b1b0f;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .auth-btn:hover {
            background: #b38f28;
            transform: scale(1.05);
        }

        .secondary-links {
            margin-top: 1.5rem;
        }

        .secondary-links a {
            color: #d4af37;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .secondary-links a:hover {
            color: #b38f28;
            text-decoration: underline;
        }

        .copyright {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="brand-header">
            <h1 class="brand-title">Admin Portal</h1>
        </div>

        <form action="backend/login.php" method="POST">
            <div class="input-group">
                <i class="fa-solid fa-user input-icon"></i>
                <input type="text" class="form-control" name="email" placeholder="Email" required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-lock input-icon"></i>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="auth-btn">Sign In</button>

            <div class="secondary-links">
                <a href="#forgot-password">Forgot Password?</a>
            </div>
        </form>
    </div>

    <div class="copyright">
        © 2025 Fortune Flog. All rights reserved.
    </div>
</body>
</html>
