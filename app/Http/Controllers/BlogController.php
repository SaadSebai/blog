<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\Blog\StoreBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use Inertia\Inertia;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Blogs/Index', [
            'blogs' => Blog::latest()->with('user:id,name')->withCount('comments')->paginate()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Blog\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        Blog::create([
            ...$request->validated(),
            'user_id' => auth()->id()
        ])
            ? session()->flash('success', 'Blog has been created successfully.')
            : session()->flash('error', 'Blog creation failed, please try again later.');

        return redirect()->route('blogs.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Blog\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $blog->update($request->validated())
            ? session()->flash('success', 'Blog has been updated successfully.')
            : session()->flash('error', 'Blog update failed, please try again later.');

        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $this->authorize('delete', $blog);

        $blog->delete()
            ? session()->flash('success', 'Blog has been deleted successfully.')
            : session()->flash('error', 'Blog delete failed, please try again later.');

        return redirect()->route('blogs.index');
    }

    public function like(Blog $blog)
    {
        $blog->increment('likes')
            ? session()->flash('success', 'You like this Blog.')
            : session()->flash('error', 'We may have a problem here, please try again later.');

        return redirect()->route('blogs.index');
    }
}
