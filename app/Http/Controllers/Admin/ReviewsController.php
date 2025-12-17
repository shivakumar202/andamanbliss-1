<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\Constraint;
use App\Models\Drive;
use App\Models\GoogleReview;
use App\Models\ReviewImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReviewsController extends Controller
{

    const MEDIA_PATH = 'page-review';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $webreviews = Review::with('reviewPhotos')
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('table_type', $request->category);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })->get();
        $google = GoogleReview::orderBy('review_date','DESC')->take(10)->get();
        $reviews = $webreviews->merge($google); 
        $categories = Review::pluck('table_type')->filter()->unique()->values();
        return view('admin.reviews.index', compact('reviews', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.reviews.create', ['review' => null]);
    }

    public function Images()
    {
        $images = ReviewImage::get();
        return view('admin.reviews.images',compact('images'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'media' => 'nullable|file|max:20000|mimetypes:image/jpeg,image/jpg,image/png,image/webp,image/avif,image/gif,video/mp4,video/webm,video/ogg,video/avi,video/quicktime',
            'name' => 'required|string|max:255',
            'review_date' => 'required|date|before_or_equal:today',
            'rating' => 'required|integer|min:1|max:5',
            'category' => 'required|in:home-page,about-page,contact-page,home-page-postcards',
            'status' => 'required|in:0,1',
            'review_link' => 'nullable|sometimes|url',
            'review' => 'required|string',
            'address' => 'required|string'
        ]);

        $path = 'page-review';
        $fileName = null;
        $fileType = null;

        DB::beginTransaction();

        try {
            if ($request->hasFile('media')) {
                if (!Storage::disk('public')->exists($path)) {
                    Storage::makeDirectory($path, 0777, true, true);
                }

                $file = $request->file('media');
                $realPath = $file->getRealPath();
                $extension = strtolower($file->getClientOriginalExtension());
                $fileName = 'page-review' . date('Ymd-His') . '-' . abs(crc32(uniqid())) . '.' . $extension;
                $fullPath = $path . '/' . $fileName;

                if (Storage::disk('public')->exists($fullPath)) {
                    Storage::disk('public')->delete($fullPath);
                }

                if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'avif'])) {
                    $image = Image::make($realPath)
                        ->resize(720, 480, function (Constraint $constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })
                        ->encode($extension);
                    Storage::disk('public')->put($fullPath, $image, 'public');
                    $fileType = 'image';
                } elseif ($extension == 'gif') {
                    Storage::disk('public')->putFileAs($path, $file, $fileName);
                    $fileType = 'image';
                } else {
                    Storage::disk('public')->putFileAs($path, $file, $fileName);
                    $fileType = 'video';
                }
            }

            $review = new Review();
            $review->table_id = rand(1000, 9999);
            $review->table_type = $request->category;
            $review->name = $request->name;
            $review->review_date = $request->review_date;
            $review->rating = $request->rating;
            $review->status = $request->status;
            $review->review_link = $request->review_link;
            $review->review = $request->review;
            $review->address = $request->address;
            $review->save();

            if ($fileName) {
                $drive = new Drive();
                $drive->table_id = $review->id;
                $drive->table_type = $path;
                $drive->file_name = $fileName;
                $drive->file_type = $fileType;
                $drive->save();
            }

            DB::commit();

            return redirect()->route('admin.reviews.index')->with('success', 'Review added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error adding review: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
            ]);

            if ($fileName && Storage::disk('public')->exists($fullPath)) {
                Storage::disk('public')->delete($fullPath);
            }

            return redirect()->back()->with('error', 'An error occurred while adding the review. Please try again.');
        }
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
        $review = Review::find($id);
        return view('admin.reviews.create', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'review_date' => 'required|date',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required|in:0,1',
            'category' => 'required|string',
            'review' => 'required|string',
            'address' => 'nullable|string|max:255',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,webp,avif,gif,mp4,webm,ogg,avi,mov|max:20480', // 20MB
            'review_link' => 'nullable|sometimes|url',

        ]);

        $review = Review::findOrFail($id);
        $path = self::MEDIA_PATH;
        $fileName = null;
        $fileType = null;

        try {
            // Handle file upload
            if ($request->hasFile('media') && $request->file('media')->isValid()) {
                // Log file details for debugging
                $file = $request->file('media');
                Log::info('File upload attempt', [
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                    'extension' => $file->getClientOriginalExtension(),
                ]);

                // Delete old media
                $oldDrive = Drive::where('table_id', $review->id)
                    ->where('table_type', $path)
                    ->first();

                if ($oldDrive && Storage::disk('public')->exists($path . '/' . $oldDrive->file_name)) {
                    if (!Storage::disk('public')->delete($path . '/' . $oldDrive->file_name)) {
                        Log::warning('Failed to delete old file: ' . $path . '/' . $oldDrive->file_name);
                    }
                    $oldDrive->delete();
                }

                // Create directory if it doesn't exist
                if (!Storage::disk('public')->exists($path)) {
                    if (!Storage::disk('public')->makeDirectory($path, 0755, true)) {
                        Log::error('Failed to create directory: ' . $path);
                        throw new \Exception('Could not create storage directory.');
                    }
                }

                // Generate unique file name
                $extension = strtolower($file->getClientOriginalExtension());
                $fileName = 'page-review-' . now()->format('Ymd-His') . '-' . uniqid() . '.' . $extension;
                $fullPath = $path . '/' . $fileName;

                // Determine file type
                $imageExtensions = ['jpg', 'jpeg', 'png', 'webp', 'avif', 'gif'];
                $fileType = in_array($extension, $imageExtensions) ? 'image' : 'video';

                // Process file
                if ($fileType === 'image') {
                    try {
                        $image = Image::make($file->getRealPath())
                            ->resize(720, 480, function (Constraint $constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            })
                            ->encode($extension);
                        if (!Storage::disk('public')->put($fullPath, $image, 'public')) {
                            Log::error('Failed to store image: ' . $fullPath);
                            throw new \Exception('Failed to store image.');
                        }
                    } catch (\Exception $e) {
                        Log::error('Image processing failed: ' . $e->getMessage());
                        throw $e;
                    }
                } else {
                    // Store video or GIF
                    if (!$file->storeAs($path, $fileName, ['disk' => 'public'])) {
                        Log::error('Failed to store file: ' . $fullPath);
                        throw new \Exception('Failed to store file.');
                    }
                }
            } else if ($request->hasFile('media') && !$request->file('media')->isValid()) {
                Log::error('Invalid file uploaded', [
                    'error' => $request->file('media')->getErrorMessage(),
                ]);
                throw new \Exception('Invalid file uploaded.');
            }

            // Update Review
            $review->update([
                'table_type' => $request->category,
                'name' => $request->name,
                'review_date' => $request->review_date,
                'rating' => $request->rating,
                'status' => $request->status,
                'review' => $request->review,
                'review_link' => $request->review_link,
                'address' => $request->address,
            ]);

            // Save new media to Drive
            if ($fileName) {
                Drive::create([
                    'table_id' => $review->id,
                    'table_type' => $path,
                    'file_name' => $fileName,
                    'file_type' => $fileType,
                ]);
            }

            return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully.');
        } catch (\Exception $e) {
            Log::error('Review update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update review: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        $drive = Drive::where('table_id', $review->id)
            ->where('table_type', 'page-review')
            ->first();

        if ($drive && $drive->file_name && Storage::disk('public')->exists('page-review/' . $drive->file_name)) {
            Storage::disk('public')->delete('page-review/' . $drive->file_name);
        }

        if ($drive) {
            $drive->delete();
        }

        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully!');
    }
}
