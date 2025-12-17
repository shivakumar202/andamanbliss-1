<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TagPages;
use App\Models\Tags;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tags::get();
        return view('admin.tag-manager.index', compact('tags'));
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
        $data = [
            'tag' => $request->input('tag'),
            'link' => $request->input('link'),
        ];

        $tags = Tags::create($data);
        return back()->with('success', 'New Tag Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tags::findorfail($id);
        $tags = Tags::get();
        return view('admin.tag-manager.index', compact('tag', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $tag = Tags::findorfail($id);
        $data = [
            'tag' => $request->input('tag'),
            'link' => $request->input('link'),
        ];
        $tag->update($data);

        return redirect()->route('admin.tag-manager.index')->with('success', 'Tag Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tags::find($id);

        $tag->delete();
        return back()->with('success', 'Tag Removed Successfully');
        //
    }

    public function tagPages()
    {
        $pages = TagPages::get();
        return view('admin.tag-manager.pages', compact('pages'));
    }

    public function storePages(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'page_url' => [
                'required',
                'regex:/^https:\/\/andamanbliss\.com(\/.*)?$/'
            ],
        ], [
            'title.required' => 'Its Very Bad Nigesh',
            'page_url.required' => 'Verry Badd',
            'page_url.regex' => 'URL Sahi se copye hua nhi',
        ]);

        $data = [
            'title' => $request->input('title'),
            'page_url' => $request->input('page_url'),
        ];
        TagPages::create($data);

        return back()->with('success', 'New Page Added');
    }

    public function editPages($id)
    {
        $page = TagPages::findorfail($id);
        $pages = TagPages::get();

        return view('admin.tag-manager.pages', compact(['page', 'pages']));
    }

    public function updatePages(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string',
            'page_url' => [
                'required',
                'regex:/^https:\/\/andamanbliss\.com(\/.*)?$/'
            ],
        ]);

        $data = [
            'title' => $request->input('title'),
            'page_url' => $request->input('page_url'),
        ];

        $page = TagPages::findorfail($id);
        $page->update($data);

        return redirect()->route('admin.tag-manager.pages')->with('success', 'Page Updated ');
    }

    public function tagDestroy($id)
    {
        $page = TagPages::findOrFail($id);
        $page->tags()->detach();
        $page->delete();
        return back()->with('success', 'Page Deleted');
    }


    public function pageTags($id)
    {
        $tags = Tags::get();
        $page = TagPages::with('tags')->findorfail($id);
        return view('admin.tag-manager.page-tags', compact('tags', 'page'));
    }

    //Page Tags Controller 

    public function storePageTags(Request $request, string $id)
    {
        $page = TagPages::with('tags')->find($id);
        $tags = $request->input('tags');
        $page->tags()->sync($tags);
        return back()->with('success', 'Page Tags Updated');
    }
}
