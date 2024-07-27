<!-- resources/views/writer/writer-console.blade.php
    page only accessible to people with the author password -->
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

    <!-- additional CSS styling -->
    <style>
        /* two-column layout */
        .form-row {
            display: flex;
            margin-bottom: 10px;
        }

        .form-label {
            /* labels in first column */
            flex: 1;
            text-align: left;
            padding-right: 10px;
        }

        .form-field {
            /* fields in second column */
            flex: 8;
        }

        /* position submit button */
        .formSubmit {
            margin-top: 10px;
            /* align button to the right */
            float: right;
        }

        /* clearfix for containing floats */
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
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
        <h1>Writer Console: Born To Inform</h1>
        <hr />
    </header>

    <main>
        <div class="userMessage">
            <!-- notify user of successful article submission -->
            @if (session('success'))
                <!-- notify user of session success -->
                <p>{{ session('success') }}</p>
                <hr />
            @endif
        </div>

        <section>
            <!-- form for writer to create article -->
            <form method="POST" action="{{ route('writer.storeArticle') }}">
                <!-- CSRF token to protect against CSRF attacks by verifying requests made from application -->
                @csrf

                <!-- form heading prompt -->
                <h2>Add a new article: </h2>

                <!-- Form rows for each input -->
                <div class="form-row">
                    <!-- get article title -->
                    <label class="form-label" for="article_title">Title</label>
                    <!-- text field for the article title -->
                    <input class="form-field" type="text" id="article_title" name="article_title" placeholder="Title"
                        required>
                </div>

                <div class="form-row">
                    <!-- get article content -->
                    <label class="form-label" for="article_content">Content</label>
                    <!-- text field for the article content -->
                    <textarea class="form-field" id="article_content" name="article_content" placeholder="..." required></textarea>
                </div>

                <div class="form-row">
                    <!-- get article category -->
                    <label class="form-label" for="category_id">Category</label>
                    <!-- article category selection -->
                    <select class="form-field" id="category_id" name="category_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-row">
                    <!-- get article tag(s) -->
                    <label class="form-label" for="selected_tags">Tag(s)</label>
                    <!-- article tag(s) selection -->
                    <select class="form-field" id="selected_tags" name="selected_tags[]" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->tag_id }}">{{ $tag->tag_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- notify user of condition for multiple selection -->
                <p class="userDirection" style="text-align: right;">
                    *Hold down the <b>cmd</b> (Mac) or <b>ctrl</b> (Windows) key to select multiple tags.
                </p>

                <!-- clearfix to contain float -->
                <div class="clearfix">
                    <!-- button to submit form -->
                    <button type="submit" class="formSubmit">Submit</button>
                </div>

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
