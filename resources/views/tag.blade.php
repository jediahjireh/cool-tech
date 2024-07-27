<!-- resources/views/tag.blade.php -->
<html>

<head>
    <!-- set the title dynamically -->
    <title>{{ $tag->tag_name }}</title>

    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- link to the main CSS file -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
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
        <!-- display content of webpage heading -->
        <h5>TAG:</h5>
    </header>

    <section>
        <!-- display the tag name -->
        <h1>#{{ $tag->tag_name }}</h1>

        <!-- display all articles associated with this tag -->
        <ul>
            <!-- loop through articles -->
            @foreach ($articles as $article)
                <li>
                    <!-- link to the article page -->
                    <a href="{{ url('/article/' . $article->article_id) }}">{{ $article->article_title }}</a>
                </li>
            @endforeach
        </ul>
    </section>

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
