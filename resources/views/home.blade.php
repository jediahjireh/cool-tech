<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- webpage title -->
    <title>Cool Tech Homepage</title>

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
            <!-- about webpage tab -->
            <li><a href="{{ url('/about') }}">ABOUT</a></li>
            <!-- user role selection tab -->
            <li><a href="{{ url('/auth/login') }}">LOGIN</a></li>
        </ul>
    </nav>

    <header>
        <!-- webpage heading -->
        <h1>Welcome Cool Techies!</h1>
    </header>

    <section>
        <!-- heading for article list -->
        <h2>Cool Tech Articles:</h2>
        <!-- foreach blade imperative to display article titles and link each to its respective article page -->
        <ul>
            <!-- loop through articles -->
            @foreach ($articles as $article)
                <!-- list the article titles -->
                <li>
                    <!-- get article id and assign it as URL subsection -->
                    <a href="{{ url('/article/' . $article->article_id) }}">{{ $article->article_title }}</a>
                </li>

                <?php
                // get position of the first occurrence of '<br/>'
                $linebreak = strpos($article->article_content, '<br/>');

                // display the content before the '<br/>' (if found); otherwise, display the whole content
                $firstParagraph = $linebreak !== false ? substr($article->article_content, 0, $linebreak) : $article->article_content;
                ?>

                <!-- display block article content
                use unescaped/raw output for the HTML tags within the content field to be rendered correctly -->
                <p>{!! $firstParagraph !!}</p>
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
