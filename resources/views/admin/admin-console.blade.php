<!-- resources/views/admin/admin-console.blade.php
    page only accessible to people with the admin password -->
<!DOCTYPE html>
<html>

<head>
    <!-- webpage title -->
    <title>Admin Console</title>

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
        <h1>Admin Console: Cool Tech Custodians</h1>
        <hr />
    </header>

    <main style="text-align: center">
        <div class="userMessage">
            <!-- notify user of successful submission -->
            @if (session('success'))
                <!-- notify user of session success -->
                <p>{{ session('success') }}</p>
                <hr />
            @endif
        </div>

        <section>
            <!-- form heading prompt -->
            <h2>Create New Article Type</h2>
            <!-- form for creating a new article type -->
            <form method="POST" action="{{ route('admin.createArticleType') }}">
                @csrf
                <label for="new_article_type">New Article Type:</label>
                <br />
                <input type="text" id="new_article_type" name="new_article_type" placeholder="Article Type" required>
                <br /><br />
                <!-- submit new article type -->
                <button type="submit" class="formSubmit">CREATE</button>
            </form>
            <hr />
        </section>

        <section>
            <!-- form heading prompt -->
            <h2>Rename Article Type</h2>
            <!-- form for renaming an article type -->
            <form method="POST" action="{{ route('admin.renameArticleType') }}">
                @csrf
                <label for="article_type_id">Select Article Type:</label>
                <br />
                <select id="article_type_id" name="article_type_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                <br /><br />
                <label for="new_article_type_name">Rename:</label>
                <br />
                <input type="text" id="new_article_type_name" name="new_article_type_name" placeholder="New Name"
                    required>
                <br /><br />
                <!-- submit renamed article type -->
                <button type="submit" class="formSubmit">RENAME</button>
            </form>
            <hr />
        </section>

        <section>
            <!-- form heading prompt -->
            <h2>Delete Article</h2>
            <!-- form for deleting an article -->
            <form method="POST" action="{{ route('admin.deleteArticle') }}">
                @csrf
                <label for="article_id">Select Article:</label>
                <br />
                <select id="article_id" name="article_id" required>
                    @foreach ($articles as $article)
                        <option value="{{ $article->article_id }}">{{ $article->article_title }}</option>
                    @endforeach
                </select>
                <br /><br />
                <!-- confirm article deletion -->
                <button type="submit" class="formSubmit">DELETE</button>
            </form>
        </section>
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
