<!-- resources/views/article.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- call function to return article's title given the subsection part of the URL -->
    <title>Article: {{ $article->article_id }}</title>

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
        <h5>ARTICLE:</h5>
    </header>

    <article>
        <!-- display block article title -->
        <h1>{{ $article->article_title }}</h1>

        <h5 style="text-align: center">
            <!-- display article date of creation -->
            Created {{ \Carbon\Carbon::parse($article->article_creation_date)->format('d F Y') }}
            •
            <!-- generate slug from displayed category name to include in URL link -->
            <a
                href="{{ url('/category/' . generateSlug($category->category_name)) }}">{{ $category->category_name }}</a>
        </h5>

        <!-- display block article content
            use unescaped/raw output for the HTML tags within the content field to be rendered correctly -->
        <p>{!! $article->article_content !!}</p>

        <!-- display tags -->
        @if ($tags->isNotEmpty())
            <!-- format tags next to each other leaving only a space between them -->
            <p>
                <!-- loop through tags -->
                @foreach ($tags as $tag)
                    <!-- link each tag to the appropriate tag view page -->
                    <a href="{{ url('/tag/' . $tag->tag_name) }}">#{{ $tag->tag_name }}</a>&nbsp;
                @endforeach
            </p>
        @endif
    </article>

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
