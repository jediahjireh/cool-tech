<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <!-- webpage title -->
    <title>Writer Console</title>

    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- link to the main CSS file -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- additional CSS styling for user role selection buttons -->
    <style>
        /* centralise webpage text */
        body {
            text-align: center;
        }

        /* style and format user role selection buttons */
        .role-selection button {
            display: block;
            margin: 20px auto;
            padding: 20px;
            width: 50%;
            font-size: 20px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: whitesmoke;
        }

        /* change button background colour upon hover */
        .role-selection button:hover {
            background-color: #007bffd6;
        }
    </style>
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
        <h1>Select Your Role</h1>
    </header>

    <main>
        <!-- redirect user to appropriate screen depending on user role -->
        <nav class="role-selection">
            <!-- redirect user to writer login form -->
            <button onclick="redirectTo('/writer/writer-login')">WRITER</button>
            <!-- redirect user to admin login form -->
            <button onclick="redirectTo('/admin/admin-login')">ADMIN</button>
            <!-- redirect user to homepage -->
            <button onclick="redirectTo('/')">GUEST</button>
        </nav>
    </main>

    <!-- JS to handle form redirection -->
    <script>
        // function to redirect user to designated console depending on role selected
        function redirectTo(url) {
            window.location.href = url;
        }
    </script>

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
