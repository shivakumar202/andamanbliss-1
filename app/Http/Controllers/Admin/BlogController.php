<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Drive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blog.index', compact('blogs'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string',
            'author' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'meta_keywords' => 'required|string',
            'meta_script' => 'required|string',
            'tags' => 'required|string',
            'publish_date' => 'required|date',
        ]);

        $newBlog = Blog::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'slug' => Str::slug($request->input('title')),
            'category' => $request->input('category'),
            'author' => $request->input('author'),
            'tags' => $request->input('tags'),
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'meta_keywords' => $request->input('meta_keywords'),
            'meta_script' => $request->input('meta_script'),
            'publish_date' => $request->input('publish_date'),
            'status' => $request->input('status', 0),
        ]);
        if ($request->hasFile('featured_image')) {
            $path = 'blog-posts';

            $drive = Drive::where('table_id', $newBlog->id)
                ->where('table_type', 'blogs-post')
                ->first();

            if ($drive) {
                if (Storage::disk('public')->exists($drive->file_name)) {
                    Storage::disk('public')->delete($drive->file_name);
                }
                $drive->delete();
            }

            if (!Storage::disk('public')->exists($path)) {
                Storage::disk('public')->makeDirectory($path, 0777, true, true);
            }

            $file = $request->file('featured_image');
            $realPath = $file->getRealPath();
            $extension = $file->getClientOriginalExtension();
            $fileName = 'blog_post' . date('Ymd-His') . '-' . abs(crc32(uniqid())) . '.' . $extension;
            $fullPath = $path . '/' . $fileName;

            if (Storage::disk('public')->exists($fullPath)) {
                Storage::disk('public')->delete($fullPath);
            }
            $resize_width = 385;
            $resize_height = 385;
            $image = Image::make($realPath)
                ->resize($resize_width, $resize_height, function (Constraint $constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode($extension);
            Storage::disk('public')->put($fullPath, $image, 'public');

            $drive = new Drive;
            $drive->table_id = $newBlog->id;
            $drive->table_type = $path;
            $drive->file_name = $fileName;
            $drive->file_type = 'image';
            $drive->save();
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:blogs,id',
            'status' => 'required|in:0,1',
        ]);

        $blog = Blog::findOrFail($request->id);
        $blog->status = (int) $request->status;
        $blog->save();

        return response()->json(['success' => true, 'status' => $blog->status]);
    }

    public function changeFeatured(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:blogs,id',
            'featured' => 'required|in:0,1',
        ]);

        $blog = Blog::findOrFail($request->id);
        $blog->featured = (int) $request->featured;
        $blog->save();

        return response()->json(['success' => true, 'featured' => $blog->featured]);
    }
public function uploadImage(Request $request)
    {
        // Validate the request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
            'alt' => 'nullable|string|max:255'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = 'blog_temp_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $filePath = 'blogs/' . $fileName;

            // Store the image
            Storage::disk('public')->put($filePath, file_get_contents($image));

            // Save to Drive model
            Drive::create([
                'table_type' => 'blogs',
                'table_id' => 0,
                'file_type' => $image->getClientMimeType(),
                'alt' => $request->input('alt', 'Uploaded image'), // Use alt text or default
                'file_name' => $fileName,
            ]);

            return response()->json([
                'success' => true,
                'url' => url(Storage::url($filePath))
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => 'No valid image uploaded'
        ], 400);
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
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.create', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'meta_keywords' => 'required|string',
            'meta_script' => 'required|string',
            'tags' => 'required|string',
            'publish_date' => 'required|date',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => Str::slug($request->title),
            'category' => $request->category,
            'author' => $request->author,
            'tags' => $request->tags,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'meta_script' => $request->meta_script,
            'publish_date' => $request->publish_date,
        ]);

        if ($request->hasFile('featured_image')) {
            $path = 'blog-posts';
            if (!Storage::disk('public')->exists($path)) {
                Storage::disk('public')->makeDirectory($path, 0777, true);
            }

            // Delete existing Drive record and image
            $drive = Drive::where('table_id', $blog->id)->where('table_type', 'blog-posts')->first();
            if ($drive) {
                if (Storage::disk('public')->exists($drive->table_type . '/' . $drive->file_name)) {
                    Storage::disk('public')->delete($drive->table_type . '/' . $drive->file_name);
                }
                $drive->delete();
            }

            $file = $request->file('featured_image');
            $realPath = $file->getRealPath();
            $extension = $file->getClientOriginalExtension();
            $fileName = 'blog_post_' . date('Ymd-His') . '-' . abs(crc32(uniqid())) . '.' . $extension;
            $fullPath = $path . '/' . $fileName;

            $resize_width = 385;
            $resize_height = 385;
            $image = Image::make($realPath)
                ->resize($resize_width, $resize_height, function (Constraint $constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode($extension);
            Storage::disk('public')->put($fullPath, $image, 'public');

            Drive::create([
                'table_id' => $blog->id,
                'table_type' => $path,
                'file_name' => $fileName,
                'file_type' => 'image',
            ]);
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        $drive = Drive::where('table_id', $blog->id)->where('table_type', 'blog-posts')->first();
        if ($drive) {
            if (Storage::disk('public')->exists($drive->table_type . '/' . $drive->file_name)) {
                Storage::disk('public')->delete($drive->table_type . '/' . $drive->file_name);
            }
            $drive->delete();
        }
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
