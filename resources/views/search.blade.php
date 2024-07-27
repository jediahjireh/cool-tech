<!-- resources/views/search.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- webpage title -->
    <title>Cool Tech About</title>

    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- link to the main CSS file -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- link to include Bootstrap CSS (Bootswatch Darkly theme) -->
    <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css">

    <style>
        /* change tab link background colour upon hover */
        .tabNav a:hover {
            text-decoration: none;
            /* cater to Bootstrap theme colours */
            background-color: #7fad95;
        }
    </style>
</head>

<body>
    <!-- cookie notice -->
    <x-alert type="info" :message="__(
        'Welcome to our cookie jar! By using our site, you\'re agreeing to indulge in a well-baked browsing experience.',
    )">
    </x-alert>

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
        <h1>Search through our articles :</h1>
    </header>

    <div class="userMessage">
        <!-- check if there is an error message stored in the session -->
        @if (session('error'))
            <!-- Bootstrap classes for styling error message as a red alert box -->
            <div class="alert alert-danger">
                <!-- output error message stored in the session -->
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- search forms -->
    <nav id="searchForms">
        <!-- GET form for article id search -->
        <form id="articleSearchForm" action="{{ url('/search/handle') }}" method="GET">
            <!-- get article id -->
            <input type="search" id="articleSearch" name="articleSearch" placeholder="Article ID">
            <br /> <br />
            <!-- submit article id to search for -->
            <input type="submit" value="Search Article" class="submitButton">
        </form>
        <br /> <br />
        <!-- GET form for category search -->
        <form id="categorySearchForm" action="{{ url('/search/handle') }}" method="GET">
            <!-- get category -->
            <input type="search" id="categorySearch" name="categorySearch" placeholder="Category">
            <br /> <br />
            <!-- submit category to search for -->
            <input type="submit" value="Search Category" class="submitButton">
        </form>
        <br /> <br />
        <!-- GET form for tag search -->
        <form id="tagSearchForm" action="{{ url('/search/handle') }}" method="GET">
            <!-- get tag -->
            <input type="search" id="tagSearch" name="tagSearch" placeholder="Tag">
            <br /> <br />
            <!-- submit tag to search for -->
            <input type="submit" value="Search Tag" class="submitButton">
        </form>
    </nav>

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
