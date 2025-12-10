<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pemesanan Kendaraan</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('assets/css/layout.app.css') }}">
    
    @stack('styles')
</head>
<body>

    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('dashboard') }}" class="nav-brand">
                <span class="brand-logo"></span>
                V-Booking
            </a>

            <div class="nav-links">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                
                @if (Auth::user()->role == 'admin')
                    <a href="{{ route('booking.index') }}" class="{{ request()->routeIs('booking.*') ? 'active' : '' }}">Kelola Pesanan</a>
                @endif

                @if (Auth::user()->role == 'approver')
                    <a href="{{ route('approval.index') }}" class="{{ request()->routeIs('approval.*') ? 'active' : '' }}">Persetujuan</a>
                @endif
            </div>

            <div class="nav-profile">
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-role">{{ ucfirst(Auth::user()->role) }}</span>
                </div>
                
                <a href="{{ route('logout') }}" 
                   class="btn-logout"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <main class="main-content">
        
        <div class="alert-container">
            @if (session('success'))
                <div class="alert alert-success">
                    <div class="alert-icon">✓</div>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    <div class="alert-icon">✕</div>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="alert-icon">!</div>
                    <div>
                        <strong>Terjadi Kesalahan:</strong>
                        <ul style="margin: 5px 0 0 15px; padding: 0;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>

        @yield('content')
    </main>

</body>
</html>