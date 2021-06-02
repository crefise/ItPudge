<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('tag', 'TagCrudController');

    Route::crud('user', 'UserCrudController');
    Route::crud('post', 'PostCrudController');
    Route::crud('like', 'LikeCrudController');
    Route::crud('like_comment', 'Like_commentCrudController');
    Route::crud('comment', 'CommentCrudController');
    Route::crud('comment_entries', 'Comment_entriesCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('category_entry', 'Category_entryCrudController');
    Route::crud('comments_entries', 'Comments_entriesCrudController');
}); // this should be the absolute last line of this file