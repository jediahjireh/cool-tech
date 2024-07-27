<!-- routes/web.php -->
<?php

// import route class
use Illuminate\Support\Facades\Route;
// import the DB script
use Illuminate\Support\Facades\DB;

// import controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WriterConsoleController;
use App\Http\Controllers\AdminConsoleController;

// import models
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;

// helper function to generate a slug (URL friendly version of subsection)
function generateSlug($string)
{
    // convert to lowercase and replace spaces with hyphens
    return strtolower(str_replace(' ', '-', $string));
}

// route for home page listing all articles
Route::get('/', function () {
    // retrieve and place all the items in the articles table into the $articles variable
    $articles = Article::all();

    // pass articles into the home view to be rendered
    return view('home', ['articles' => $articles]);
});

// route for displaying a specific article
Route::get('/article/{id}', function ($id) {
    // retrieve the record where the article's id matches the subsection part of the URL
    $article = Article::find($id);

    // if article does not exist
    if (!$article) {
        // handle gracefully by displaying the 404 page
        abort(404);
    }

    // retrieve category based on category_id from the article
    $category = Category::find($article->category_id);

    // retrieve tags for the article
    $tags = $article->tags;

    // pass article, category and tags to the article view
    return view(
        'article',
        [
            'article' => $article,
            'category' => $category,
            'tags' => $tags
        ]
    );
})
    // ensure that the id parameter in the route URL consists only of numeric digits (id data type is int)
    ->where('id', '[0-9]+');

// route for about page describing nature of the website (article)
Route::get('/about', function () {
    return view('about');
});

// route to define $subsection to return page's subsection view
Route::get('/legal/{subsection}', function ($subsection) {
    return view('legal', ['subsection' => $subsection]);
})
    // regular expression constraint on the URL to ensure only tou and privacy are valid subsections
    ->where('subsection', '(tou|privacy)');

// route for category view page
Route::get('/category/{slug}', function ($slug) {

    // retrieve category based on slug
    $category = DB::table('categories')
        // case-insensitive search for category name matching modified slug (hyphens removed)
        ->whereRaw('LOWER(REPLACE(category_name, " ", "-")) = ?', [strtolower($slug)])
        ->first();

    // if category does not exist
    if (!$category) {
        // handle gracefully by displaying the 404 page
        abort(404);
    }

    // retrieve articles belonging to the category
    $articles = DB::table('articles')
        // join the categories table to get the category details
        ->join('categories', 'articles.category_id', '=', 'categories.category_id')
        // filter results to only include rows where 'category_id' matches the specified category's id
        ->where('articles.category_id', $category->category_id)
        // select the necessary columns
        ->select('articles.*', 'categories.category_name')
        // execute query and get results
        ->get();


    // pass category and articles to the category view
    return view('category', [
        'category' => $category,
        'articles' => $articles
    ]);

})
    // define constraint for slug generation
    ->where('slug', '[A-Za-z0-9-]+');

// route for tag view page
Route::get('/tag/{hashtag}', function ($hashtag) {
    // hashtags are not case sensitive

    // retrieve tag based on hashtag
    $tag = Tag::where('tag_name', $hashtag)->firstOrFail();

    // if tag does not exist
    if (!$tag) {
        // handle gracefully by displaying the 404 page
        abort(404);
    }

    // retrieve articles associated with the tag
    $articles = $tag->articles;

    // pass tag and articles to the tag view
    return view('tag', ['tag' => $tag, 'articles' => $articles]);
})
    // define constraint for hashtag generation
    ->where('hashtag', '[A-Za-z0-9-]+');

// search page route
Route::get('/search', function () {
    return view('search');
});

// consolidated search handling route
Route::get('/search/handle', function () {
    // check which form was submitted :

    // article id search form submitted
    if (request()->has('articleSearch')) {
        // retrieve input value
        $articleId = request('articleSearch');

        // search for the article
        $article = DB::table('articles')->where('article_id', $articleId)->first();

        // check if article found
        if ($article) {
            // redirect page to article searched for
            return redirect('/article/' . $article->article_id);
        }

        // notify user of article id not being found
        return redirect()->back()->with('error', 'Article not found.')->withInput();
    }

    // category search form submitted
    if (request()->has('categorySearch')) {
        // retrieve input value
        $categoryName = request('categorySearch');

        // search for categories that match the input
        $categories = DB::table('categories')
            ->where('category_name', 'LIKE', "%{$categoryName}%")
            ->get();

        // if search result found
        if ($categories->count() === 1) {
            // create slug from input value
            $slug = generateSlug($categories->first()->category_name);
            // redirect page to category searched for
            return redirect('/category/' . $slug);
        }
        // handle multiple categories found
        else if ($categories->count() > 1) {
            // notify user
            return redirect()->back()->with('error', 'Multiple search results found. Please specify category.')->withInput();
        }

        // notify user of category not being found
        return redirect()->back()->with('error', 'Category not found.')->withInput();
    }

    // tag search form submitted
    if (request()->has('tagSearch')) {
        // retrieve input value
        $tagName = request('tagSearch');

        // search for tags that match the input
        $tags = DB::table('tags')
            ->where('tag_name', 'LIKE', "%{$tagName}%")
            ->get();

        // if search result found
        if ($tags->count() === 1) {
            // redirect page to tag searched for
            return redirect('/tag/' . $tags->first()->tag_name);
        }
        // handle multiple categories found
        else if ($tags->count() > 1) {
            // notify user
            return redirect()->back()->with('error', 'Multiple search results found. Please specify tag name.')->withInput();
        }

        // notify user of tag not being found
        return redirect()->back()->with('error', 'Tag not found.')->withInput();
    }

    // reload search page if none of the search types match
    return redirect('/search');
});

// login page route
Route::get('/auth/login', function () {
    return view('auth.login');
})->name('login');

// middleware controller functionality :

// route for showing the writer login form (this will be accessed directly via the URL)
Route::view('/writer/writer-login', 'writer.writer-login')->name('writer.login-form');

// route for handling writer login form submission
Route::post('/writer/login', [AuthController::class, 'writerLogin'])->name('writer.login');

// protected writer routes
Route::middleware(['writer'])->group(function () {
    // route for showing the writer console (protected by middleware)
    Route::get('/writer/writer-console', [WriterConsoleController::class, 'showConsole'])->name('writer.console');

    // route for storing a new article created by writer
    Route::post('/writer/store-article', [WriterConsoleController::class, 'storeNewArticle'])->name('writer.storeArticle');
});

// route for showing the admin login form (this will be accessed directly via the URL)
Route::view('/admin/admin-login', 'admin.admin-login')->name('admin.login-form');

// route for handling admin login form submission
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');

// protected admin routes
Route::middleware(['admin'])->group(function () {
    // route for showing the admin console (protected by middleware)
    Route::get('/admin/admin-console', [AdminConsoleController::class, 'showConsole'])->name('admin.console');

    // route for creating a new article type
    Route::post('/admin/create-article-type', [AdminConsoleController::class, 'createArticleType'])->name('admin.createArticleType');

    // route for renaming an article type
    Route::post('/admin/rename-article-type', [AdminConsoleController::class, 'renameArticleType'])->name('admin.renameArticleType');

    // route for deleting an article
    Route::post('/admin/delete-article', [AdminConsoleController::class, 'deleteArticle'])->name('admin.deleteArticle');
});
