<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Vanity') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Instrument Sans', sans-serif;
                background: linear-gradient(135deg, #fef7f0 0%, #fce7e1 25%, #f8d7e4 50%, #e8d5f0 75%, #d4e2f7 100%);
                min-height: 100vh;
                color: #1b1b18;
                overflow-x: hidden;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem;
            }

            .auth-container {
                width: 100%;
                max-width: 400px;
                z-index: 2;
                position: relative;
            }

            .auth-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-radius: 2rem;
                padding: 3rem;
                border: 1px solid rgba(255, 255, 255, 0.2);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            }

            .auth-title {
                font-size: 2.5rem;
                font-weight: 600;
                text-align: center;
                margin-bottom: 2rem;
                background: linear-gradient(135deg, #dc2626 0%, #db2777 25%, #c026d3 50%, #7c3aed 75%, #2563eb 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-label {
                display: block;
                font-weight: 500;
                color: #374151;
                margin-bottom: 0.5rem;
            }

            .form-input {
                width: 100%;
                padding: 0.75rem 1rem;
                border: 2px solid #e5e7eb;
                border-radius: 0.75rem;
                font-size: 1rem;
                transition: all 0.3s ease;
                background: rgba(255, 255, 255, 0.8);
            }

            .form-input:focus {
                outline: none;
                border-color: #dc2626;
                box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
                background: white;
            }

            .form-error {
                color: #dc2626;
                font-size: 0.875rem;
                margin-top: 0.25rem;
            }

            .auth-button {
                width: 100%;
                background: linear-gradient(135deg, #dc2626, #db2777);
                color: white;
                padding: 0.75rem 1.5rem;
                border: none;
                border-radius: 0.75rem;
                font-weight: 600;
                font-size: 1rem;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0 10px 30px rgba(220, 38, 38, 0.3);
            }

            .auth-button:hover {
                transform: translateY(-2px);
                box-shadow: 0 20px 40px rgba(220, 38, 38, 0.4);
            }

            .auth-links {
                text-align: center;
                margin-top: 2rem;
                padding-top: 2rem;
                border-top: 1px solid #e5e7eb;
            }

            .auth-link {
                color: #6b7280;
                text-decoration: none;
                font-size: 0.875rem;
                transition: color 0.3s ease;
            }

            .auth-link:hover {
                color: #dc2626;
            }

            .floating-shapes {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                overflow: hidden;
                z-index: 1;
                pointer-events: none;
            }

            .shape {
                position: absolute;
                border-radius: 50%;
                background: linear-gradient(135deg, rgba(220, 38, 38, 0.1), rgba(219, 39, 119, 0.1));
                animation: float 6s ease-in-out infinite;
            }

            .shape:nth-child(1) {
                width: 100px;
                height: 100px;
                top: 10%;
                left: 10%;
                animation-delay: 0s;
            }

            .shape:nth-child(2) {
                width: 150px;
                height: 150px;
                top: 20%;
                right: 10%;
                animation-delay: 2s;
            }

            .shape:nth-child(3) {
                width: 80px;
                height: 80px;
                bottom: 20%;
                left: 20%;
                animation-delay: 4s;
            }

            .shape:nth-child(4) {
                width: 120px;
                height: 120px;
                bottom: 10%;
                right: 20%;
                animation-delay: 1s;
            }

            @keyframes float {
                0%, 100% {
                    transform: translateY(0px);
                }
                50% {
                    transform: translateY(-20px);
                }
            }

            @media (max-width: 640px) {
                .auth-card {
                    padding: 2rem;
                    margin: 1rem;
                }

                .auth-title {
                    font-size: 2rem;
                }
            }
        </style>
    @endif
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="auth-container">
        <div class="auth-card">
            <h1 class="auth-title">{{ $title ?? 'Welcome' }}</h1>

            {{ $slot }}
        </div>
    </div>
</body>
</html>
