<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Rehan Coal Management System</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/wellcome.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

    </head>
    <body id="header-shadow">
        <div class="outer-wrapper">
            <div class="inner-wrapper">
                <div class="header-wrapper">
                    <span class="span">
                         WELCOME TO REHAN COAL MANAGEMENT SYSTEM.
                    </span>
                    <h1></h1>
                    @if (Route::has('login'))
                        <div>
                            @auth
                                <a href="{{ url('/home') }}" class="textalign" style="border-radius: 12px"><i class="fas fa-tools"></i> Jump To System</a>
                            @else
                                <a href="{{ route('login') }}" class="textalign" style="border-radius: 12px"><i class="fas fa-sign-in-alt"></i> Sign-In</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="textalign" style="border-radius: 12px"><i class="fas fa-user-plus"></i> Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
