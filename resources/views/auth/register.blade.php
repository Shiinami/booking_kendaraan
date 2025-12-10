<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
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
                    <h2>Buat Akun</h2>
                    <h3>Silahkan isi data berikut!</h3>
                </div>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    
                    <div class="input-group">
                        <input type="text" name="name" placeholder="Full Name" required value="{{ old('name') }}"/>
                    </div>

                    <div class="input-group">
                        <input type="email" name="email" placeholder="Email Address" required value="{{ old('email') }}"/>
                    </div>
                    
                    <div class="input-group password-group">
                        <input type="password" name="password" class="pwd-input" placeholder="Password" required />
                        <span class="toggle-password">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </span>
                    </div>

                    <div class="input-group password-group">
                        <input type="password" name="password_confirmation" class="pwd-input" placeholder="Confirm Password" required />
                        <span class="toggle-password">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </span>
                    </div>

                    <div class="row row-left">
                        <label class="checkbox">
                            <input type="checkbox" name="terms" required />
                            <span class="check"></span>
                            <span>I agree to the <a href="#">Terms & Conditions</a></span>
                        </label>
                    </div>

                    <button type="submit">Sign Up</button>
                </form>

                <p class="signup-link">Already have an account? <a href="{{ route('login') }}">Log In</a></p>
            </div>

            <div class="hero">
                <div class="hero-content">
                    <h1>Unlock your<br>potential now.</h1>
                </div>
                <img src="{{ asset('assets/img/Frame 31.png') }}" alt="" class="graphic"/>
            </div>
        </div>
    </div>

    <script>
        const toggles = document.querySelectorAll('.toggle-password');

        toggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('svg');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.style.stroke = "#7e30ff";
                } else {
                    input.type = 'password';
                    icon.style.stroke = "#888";
                }
            });
        });
    </script>
</body>
</html>