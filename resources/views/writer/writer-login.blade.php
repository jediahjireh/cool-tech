<!-- resources/views/writer/writer-login.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <!-- webpage title -->
    <title>Writer Login</title>

    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- link to the main CSS file -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <nav class="tabNav">
        <ul>
            <!-- home webpage tab -->
            <li><a href="{{ url('/') }}">HOME</a></li>
            <!-- about webpage tab -->
            <li><a href="{{ url('/about') }}">ABOUT</a></li>
            <!-- user role selection tab -->
            <li><a href="{{ url('/auth/login') }}">LOGIN</a></li>
        </ul>
    </nav>

    <header>
        <!-- webpage heading -->
        <h1>Writer Login</h1>
    </header>

    <main class="centreForm">
        <form method="POST" action="{{ route('writer.login') }}">
            <!-- CSRF token to protect against CSRF attacks by verifying requests made from application -->
            @csrf
            <!-- get writer password -->
            <label for="password">Global writer password:</label>
            <br /><br />
            <input type="password" name="password" placeholder="writer-password" required>
            <br /><br />

            <!-- submit writer password -->
            <button type="submit" class="formSubmit">Login</button>
        </form>

        <div class="userMessage">
            <!-- notify user of invalid password entry -->
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </main>

    <footer>
        <hr />
        <!-- link to search page -->
        <a href="{{ url('/search') }}">🔎 Search articles</a>
        <hr />
        <br /><br />
        <!-- terms of use link -->
        <a href="{{ url('/legal/tou') }}">Terms of Use •</a>
        <!-- privacy policy link -->
        <a href="{{ url('/legal/privacy') }}">Privacy Policy</a>
        <br />
        <!-- author -->
        <h4>Created by <a href="https://jediahjireh.wordpress.com">Jediah Jireh Naicker</a></h4>
        <!-- copyright -->
        &copy; 2024 Cool Tech
    </footer>
</body>

</html>
