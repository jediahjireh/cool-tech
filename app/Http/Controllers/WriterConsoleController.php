<?php
// app/Http/Controllers/WriterConsoleController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// import models
use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;

class WriterConsoleController extends Controller
{
    // function to collect and submit relevant items for writer console to be generated
    public function showConsole()
    {
        // retrieve all categories from the database
        $categories = Category::all();
        // retrieve all tags from the database
        $tags = Tag::all();
        // return populated writer console view
        return view('writer.writer-console', ['categories' => $categories, 'tags' => $tags]);

    }

    // function to store article in database
    public function storeNewArticle(Request $request)
    {
        // validate request data
        $request->validate([
            'article_title' => 'required|string|max:255',
            'article_content' => 'required',
            'category_id' => 'required|integer|exists:categories,category_id',
            'selected_tags' => 'nullable|array',
        ]);

        // create a new article instance
        $article = new Article();
        $article->article_title = $request->input('article_title');
        $article->article_content = $request->input('article_content');
        $article->category_id = $request->input('category_id');
        $article->save();

        // process tags if provided
        if ($request->has('selected_tags') && is_array($request->selected_tags)) {
            // loop through selected tags
            foreach ($request->selected_tags as $tagId) {
                // find the tag by its ID and attach it to the article through the pivot table
                $tag = Tag::find($tagId);
                if ($tag) {
                    // use tag_id as the primary key
                    $article->tags()->attach($tag->tag_id);
                }
            }
        }

        // redirect back to the console with a success message
        return redirect()->route('writer.console')->with('success', 'Article submitted successfully.');
    }
}
