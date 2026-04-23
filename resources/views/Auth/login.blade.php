<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiliate Program Login</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #0f172a;
            --secondary-color: #334155;
            --accent-color: #2563eb;
            --light-bg: #f8fafc;
            --dark-text: #0f172a;
            --light-text: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background:
                radial-gradient(circle at top left, rgba(15, 23, 42, 0.06), transparent 30%),
                radial-gradient(circle at bottom right, rgba(37, 99, 235, 0.08), transparent 28%),
                #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .login-container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            min-height: 500px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        /* Left side - Logo & Affiliate Info */
        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            top: -100px;
            left: -100px;
        }

        .login-left::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            bottom: -80px;
            right: -80px;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 40px;
            z-index: 2;
        }

        .logo {
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.96);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.18);
        }

        .logo i {
            font-size: 60px;
            color: var(--primary-color);
        }

        .brand-name {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .brand-tagline {
            font-size: 16px;
            opacity: 0.9;
        }

        .affiliate-features {

            z-index: 2;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .feature-text {
            font-size: 15px;
        }

        /* Right side - Login Form */
        .login-right {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 35px;
        }

        .login-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark-text);

        }

        .login-subtitle {
            color: var(--light-text);
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: var(--primary-color);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            cursor: pointer;
            padding: 0;
        }

        .password-toggle:focus {
            outline: none;
        }

        .password-wrapper .form-control {
            padding-right: 70px;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-text);
            margin-bottom: 4px;
            display: block;
            font-size: 14px;
        }

        .form-control {
            padding: 10px 12px 10px 40px;
            border: none;
            border-bottom: 2px solid #cbd5e1;
            border-radius: 0;
            font-size: 15px;
            transition: all 0.3s;
            background: transparent;
            color: #0f172a;
        }

        .form-control:focus {
            border-bottom-color: #0f172a;
            box-shadow: none;
            background: transparent;
        }

        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--light-text);
            pointer-events: none;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .form-check-label {
            color: var(--light-text);
        }

        .forgot-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .btn-login {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 20px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 18px rgba(15, 23, 42, 0.22);
        }

        .register-link {
            text-align: center;
            color: var(--light-text);
            font-size: 14px;
            margin-top: 15px;
        }

        .register-link a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
        }

        .alert-danger {
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 25px;
            border-left: 4px solid #dc3545;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 500px;
            }

            .login-left {
                padding: 30px 25px;
                border-radius: 15px 15px 0 0;
            }

            .login-right {
                padding: 30px 25px;
            }

            .logo {
                width: 90px;
                height: 90px;
            }

            .logo i {
                font-size: 45px;
            }
        }

        @media (max-width: 480px) {

            .login-left,
            .login-right {
                padding: 25px 20px;
            }

            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
            }

            .forgot-link {
                margin-top: 10px;
            }
        }

        /* Animation for form */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-right form {
            animation: fadeIn 0.8s ease-out;
        }
    </style>
</head>

<body class="">
    <div class="login-container">
        <!-- Left side: Logo & Affiliate Info -->
        <div class="login-left p-4 text-white md:p-6">
            <div class="logo-container">
                <div class="logo border border-slate-200">
                    <img src="{{ asset('images/logo.png') }}" alt="Affiliate Program Logo" style="width: 100%; height: 100%; object-fit: contain;">
                </div>
                <h1 class="brand-name">AffiliatePro</h1>
                <p class="brand-tagline">Maximize Your Earnings With Our Program</p>
            </div>

            <div class="affiliate-features">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="feature-text">
                        <strong>High Commission Rates</strong> - Earn up to 30% on every referral
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="feature-text">
                        <strong>Real-time Tracking</strong> - Monitor your referrals and earnings
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <div class="feature-text">
                        <strong>Bonus Rewards</strong> - Exclusive bonuses for top performers
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="feature-text">
                        <strong>Dedicated Support</strong> - Get help from our affiliate managers
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side: Login Form -->
        <div class="login-right bg-white">
            <div class="login-header">
                <h2 class="p-1 text-3xl font-bold text-slate-900">Affiliate Login</h2>
                <p class="text-slate-500">Access your affiliate dashboard to track earnings and performance</p>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger border border-rose-200 bg-rose-50 text-rose-700">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                </div>

                <div class="form-group password-wrapper">
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                    <button type="button" class="password-toggle" id="passwordToggle">SHOW</button>
                </div>

                <div class="remember-forgot">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" required>
                        <label class="text-slate-600" for="remember">Remember me</label>
                    </div>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <button type="submit" class="btn-login">
                    Login
                </button>


                <div class="register-link">
                    Not an affiliate yet? <a href="#">Join our program now</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Simple form interaction enhancement
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.getElementById('passwordToggle');

            // Add focus effects
            [emailInput, passwordInput].forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.querySelector('.input-icon').style.color = '#4361ee';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.querySelector('.input-icon').style.color = '#6c757d';
                });
            });

            passwordToggle.addEventListener('click', function() {
                const isHidden = passwordInput.type === 'password';
                passwordInput.type = isHidden ? 'text' : 'password';
                this.textContent = isHidden ? 'HIDE' : 'SHOW';
            });

            // Form submission animation
            const loginForm = document.querySelector('form');
            loginForm.addEventListener('submit', function(e) {
                const btn = this.querySelector('.btn-login');
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging in...';
                btn.disabled = true;
            });
        });
    </script>
</body>

</html>
