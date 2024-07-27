<?php
// app/Http/Controllers/AdminConsoleController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// import models
use App\Models\Category;
use App\Models\Article;

class AdminConsoleController extends Controller
{
    // function to show admin console
    public function showConsole()
    {
        // retrieve all categories from the database
        $categories = Category::all();
        // retrieve all articles from the database
        $articles = Article::all();
        // return populated admin console view
        return view('admin.admin-console', ['categories' => $categories, 'articles' => $articles]);
    }

    // function to create a new article type
    public function createArticleType(Request $request)
    {
        // validate request data
        $request->validate([
            'new_article_type' => 'required|string|max:255',
        ]);

        // create a new category instance
        $category = new Category();
        $category->category_name = $request->input('new_article_type');
        $category->save();

        // redirect back to the console with a success message
        return redirect()->route('admin.console')->with('success', 'Article type created successfully!');
    }

    // function to rename an article type
    public function renameArticleType(Request $request)
    {
        // validate request data
        $request->validate([
            'article_type_id' => 'required|integer|exists:categories,category_id',
            'new_article_type_name' => 'required|string|max:255',
        ]);

        // find the category and update its name
        $category = Category::find($request->input('article_type_id'));
        $category->category_name = $request->input('new_article_type_name');
        $category->save();

        // redirect back to the console with a success message
        return redirect()->route('admin.console')->with('success', 'Article type renamed successfully!');
    }

    // function to delete an article
    public function deleteArticle(Request $request)
    {
        // validate request data
        $request->validate([
            'article_id' => 'required|integer|exists:articles,article_id',
        ]);

        // find and delete the article
        $article = Article::find($request->input('article_id'));
        $article->delete();

        // redirect back to the console with a success message
        return redirect()->route('admin.console')->with('success', 'Article deleted successfully!');
    }
}
