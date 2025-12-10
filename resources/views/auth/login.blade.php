<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="content">
                <div class="brand-logo">
                    <img src="{{ asset('assets/img/Frame 31.png') }}" alt="logo" />
                    <span>Kosiwa</span>
                </div>

                <div class="header-text">
                    <h2>Login</h2>
                    <h3>Masukkan data untuk login</h3>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="email" placeholder="Email Address" name="email" required
                            value="{{ old('email') }}" />
                    </div>

                    <div class="input-group password-group">
                        <input type="password" id="passwordInput" placeholder="Password" name="password" required />
                        <span class="toggle-password" onclick="togglePassword()">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </span>
                    </div>

                    <button type="submit">Log In</button>
                </form>

                <p class="signup-link">Tidak punya akun? <a href="{{ route('register') }}">Sign Up</a></p>
            </div>

            <div class="hero">
                <div class="hero-overlay"></div>

                <div class="hero-content">
                    <h1>Demo Access</h1>
                    <p class="subtitle">Gunakan akun berikut untuk masuk:</p>

                    <div class="credentials-grid">
                        <div class="cred-card">
                            <div class="position-badge" style="background: #ff9f43;">Admin Logistik</div>
                            <div class="cred-detail">
                                <span>E:</span> <strong>admin@kosiwa.com</strong>
                            </div>
                            <div class="cred-detail">
                                <span>P:</span> <strong>password</strong>
                            </div>
                        </div>

                        <div class="cred-card">
                            <div class="position-badge">Manager Ops 1</div>
                            <div class="cred-detail">
                                <span>E:</span> <strong>ardhan@kosiwa.com</strong>
                            </div>
                            <div class="cred-detail">
                                <span>P:</span> <strong>password</strong>
                            </div>
                        </div>

                        <div class="cred-card">
                            <div class="position-badge">Kepala Cabang 1</div>
                            <div class="cred-detail">
                                <span>E:</span> <strong>amir@kosiwa.com</strong>
                            </div>
                            <div class="cred-detail">
                                <span>P:</span> <strong>password</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <img src="{{ asset('assets/img/Frame 31.png') }}" alt="" class="graphic" />
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('passwordInput');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.style.stroke = "#7e30ff";
            } else {
                passwordInput.type = 'password';
                eyeIcon.style.stroke = "#888";
            }
        }
    </script>
</body>

</html>
