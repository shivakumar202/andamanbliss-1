<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
 public function index(Request $request)
{
    $blogs = Blog::where('status', 1)
        ->with('photo')->orderBy('id', 'desc')
        ->when(!empty($request->keyword), function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('category', 'like', '%' . $request->keyword . '%')
                  ->orWhere('tags', 'like', '%' . $request->keyword . '%')
                  ->orWhere('title', 'like', '%' . $request->keyword . '%');
            });
        })
        ->paginate(10);

    return view('blog.index', compact('blogs'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $blogContent = Blog::where('slug', $slug)->with('photo')->firstOrFail();
        $Listblogs = Blog::where('status', 1)->with('photo')->get();

        return view('blog.show', compact('blogContent','Listblogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
