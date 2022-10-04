<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Models\Blog;
use App\Models\Comment;
use Inertia\Inertia;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Blog $blog)
    {
        return Inertia::render('Blogs/Index', [
            'comments' => $blog->comments()->with('user:id,name')->latest()->paginate(3)
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Comment\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request, Blog $blog)
    {
        $blog->comments()
            ->create([
                ...$request->validated(),
                'user_id' => auth()->id()
            ])

        ? session()->flash('success', 'Comment has been created successfully.')
        : session()->flash('error', 'Comment creation failed, please try again later.');

        return redirect()->route('blogs.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Comment\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Blog $blog, Comment $comment)
    {
        $blog->comments()
            ->update($request->validated())

        ? session()->flash('success', 'Comment has been updated successfully.')
        : session()->flash('error', 'Comment update failed, please try again later.');

        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete()

        ? session()->flash('success', 'Comment has been deleted successfully.')
        : session()->flash('error', 'Comment delete failed, please try again later.');

        return redirect()->route('blogs.index');
    }
}
