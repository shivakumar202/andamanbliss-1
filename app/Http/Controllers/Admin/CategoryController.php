<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategorySections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Drive;
use App\Models\Facility;
use App\Models\Faq;
use App\Models\MetaHeadings;
use App\Models\Review;
use App\Models\Service;
use ElementorPro\Modules\Woocommerce\Widgets\Categories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\Constraint;

class CategoryController extends Controller
{
    protected $types;
    protected $ratings;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->types = [
            'tour',
            'hotel',
            'activity',
            'cruise',
            'cab',
            'bike'
        ];
        $this->ratings = [
            ['name' => 'premium', 'value' => 5],
            ['name' => 'luxury', 'value' => 4],
            ['name' => 'standard', 'value' => 3],
            ['name' => 'budget', 'value' => 2],
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::query()
            ->when(!empty($request->type), function ($query) use ($request) {
                $query->where('type', $request->type);
            })
            ->get();

        $types = $this->types;
        $ratings = $this->ratings;
        return view('admin.categories.index')->with(compact('categories', 'types', 'ratings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = $this->types;
        $ratings = $this->ratings;
        return view('admin.categories.create')->with(compact('types', 'ratings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',

                Rule::unique('categories', 'name')
                    ->where('name', $request->name)
                    ->where('type', $request->type),
            ],
            'type' => 'required|string|max:255|in:tour,hotel,activity,cruise,cab,bike',
            'rating' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'best_seller' => 'required|in:0,1',
            'featured' => 'required|in:0,1',

        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $category = new Category;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->type = $request->type;
        $category->rating = $request->rating;
        $category->title = $request->title;
        $category->description = $request->description;
        $category->best_seller = $request->best_seller;
        $category->featured = $request->featured;
        $category->save();

        return back()
            ->with('success', __('Category saved successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        $ratings = $this->ratings;
        return view('admin.categories.show')->with(compact('category', 'ratings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        $types = $this->types;
        $ratings = $this->ratings;
        return view('admin.categories.create')->with(compact('category', 'types', 'ratings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')
                    ->where('name', $request->name)
                    ->where('type', $request->type)
                    ->ignore($id),
            ],
            'type' => 'required|string|max:255|in:tour,hotel,activity,cruise,cab,bike',
            'rating' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'best_seller' => 'required|in:0,1',
            'featured' => 'required|in:0,1',

        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->type = $request->type;
        $category->rating = $request->rating;
        $category->title = $request->title;
        $category->description = $request->description;
        $category->best_seller = $request->best_seller;
        $category->featured = $request->featured ?? 1;
        $category->save();

        return back()
            ->with('success', __('Category updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back()
            ->with('success', __('Category deleted successfully.'));
    }




    // Review Section


    public function reviews(Request $request, $categoryId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $review = Review::findOrFail($id);
            $review->delete();

            return redirect('admin/categories/' . $categoryId . '/reviews')
                ->with('success', __('Category review deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            $rules = [
                'name' => [
                    'required',
                    'string',
                    'max:255',

                ],
                'address' => 'required|string|max:255',
                'review' => 'required|string',
                'media' => 'nullable|file|max:20000|mimetypes:image/jpeg,image/jpg,image/png,image/webp,image/avif,image/gif,video/mp4,video/webm,video/ogg,video/avi,video/quicktime',
                'review_date' => 'required|date|before_or_equal:today',
                'rating' => 'required|integer|min:1|max:5',
                'status' => 'required|in:0,1',
                'review_link' => 'nullable|sometimes|url',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }

            DB::beginTransaction();

            try {
                $review = Review::findOrNew($id);
                $review->table_id = $categoryId;
                $review->table_type = 'category';
                $review->name = $request->name;
                $review->address = $request->address;
                $review->review = $request->review;
                $review->review_date = $request->review_date;
                $review->rating = $request->rating;
                $review->status = $request->status;
                $review->review_link = $request->review_link;
                $review->save();

                $path = 'category-review';
                $fileName = null;
                $fileType = null;

              if ($request->hasFile('media')) {
                            if (!Storage::disk('public')->exists($path)) {
                                Storage::disk('public')->makeDirectory($path, 0777, true, true);
                            }

                            $file = $request->file('media');
                            $realPath = $file->getRealPath();
                            $extension = strtolower($file->getClientOriginalExtension());
                            $fileName = 'category-review-' . date('Ymd-His') . '-' . abs(crc32(uniqid())) . '.' . $extension;
                            $fullPath = $path . '/' . $fileName;

                            if (Storage::disk('public')->exists($fullPath)) {
                                Storage::disk('public')->delete($fullPath);
                            }

                            $imageExtensions = ['jpg', 'jpeg', 'png', 'webp', 'avif', 'gif'];

                            if (in_array($extension, $imageExtensions)) {
                                if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'avif'])) {
                                    $image = Image::make($realPath)
                                        ->resize(720, 480, function (Constraint $constraint) {
                                            $constraint->aspectRatio();
                                            $constraint->upsize();
                                        })
                                        ->encode($extension);

                                    Storage::disk('public')->put($fullPath, $image, 'public');
                                } else {
                                    Storage::disk('public')->putFileAs($path, $file, $fileName);
                                }

                                $fileType = 'image';
                            } else {
                                Storage::disk('public')->putFileAs($path, $file, $fileName);
                                $fileType = 'video';
                            }

                            if ($fileName) {
                                $drive = new Drive();
                                $drive->table_id = $review->id;
                                $drive->table_type = $path;
                                $drive->file_name = $fileName;
                                $drive->file_type = $fileType;
                                $drive->save();
                            }
                        }


                DB::commit();

                return redirect('admin/categories/' . $categoryId . '/reviews')
                    ->with('success', __('Category review ' . ($id ? 'updated' : 'saved') . ' successfully.'));
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withInput()->with('error', 'Something went wrong while saving the review.');
            }
        }

        $category = Category::findOrFail($categoryId);
        $review = Review::find($id);
        $reviews = Review::where('table_id', $categoryId)
            ->where('table_type', 'category')
            ->get();

        return view('admin.categories.reviews')->with(compact('category', 'review', 'reviews'));
    }


    public function faqs(Request $request, $categoryId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $faq = Faq::findOrFail($id);
            $faq->delete();

            return redirect('admin/categories/' . $categoryId . '/faqs')
                ->with('success', __('category faq deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            $rules['answer'] = 'required|string';
            if ($id) {
                $rules['question'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('faqs', 'question')
                        ->where('question', $request->question)
                        ->where('table_id', $categoryId)
                        ->where('table_type', 'category')
                        ->ignore($id),
                ];
            } else {
                $rules['question'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('faqs', 'question')
                        ->where('question', $request->question)
                        ->where('table_id', $categoryId)
                        ->where('table_type', 'category'),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $faq = Faq::findOrNew($id);
            $faq->table_id = $categoryId;
            $faq->table_type = 'category';
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();

            return redirect('admin/categories/' . $categoryId . '/faqs')
                ->with('success', __('Category faq ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $category = Category::findOrFail($categoryId);

        $faq = Faq::find($id);

        $faqs = Faq::where('table_id', $categoryId)
            ->where('table_type', 'category')
            ->get();

        return view('admin.categories.faqs')->with(compact('category', 'faq', 'faqs'));
    }

    public function images(Request $request, $categoryId, $id = null)
    {
        $path = 'category_photo';

        if ($request->isMethod('delete')) {
            $drive = Drive::findOrFail($id);
            $drive->delete();

            return redirect('admin/categories/' . $categoryId . '/images')
                ->with('success', __('Category image deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            $rules['photo'] = 'required|file|image|mimes:jpeg,jpg,png|max:2048';

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            if ($request->hasFile('photo')) {
                // $path = 'tour_photo';
                if ($id) {
                    $drive = Drive::find($id);
                    if ($drive) {
                        if (Storage::disk('public')->exists($drive->file_name)) {
                            Storage::disk('public')->delete($drive->file_name);
                        }
                        $drive->delete();
                    }
                }

                if (!Storage::disk('public')->exists($path)) {
                    Storage::makeDirectory($path, 0777, true, true);
                }

                $file = $request->file('photo');
                $realPath = $file->getRealPath();
                $extension = $file->getClientOriginalExtension();
                $fileName = 'photo-' . date('Ymd-His') . '-' . abs(crc32(uniqid())) . '.' . $extension;
                $fullPath = $path . '/' . $fileName;
                if (Storage::disk('public')->exists($fullPath)) {
                    Storage::disk('public')->delete($fullPath);
                }

                $resize_width = 720;
                $resize_height = 480;
                $image = Image::make($realPath)
                    ->resize($resize_width, $resize_height, function (Constraint $constraint) {
                        $constraint->aspectRatio(); // auto height
                        $constraint->upsize(); // prevent possible upsizing
                    })
                    ->encode($extension); // encode image format
                Storage::disk('public')->put($fullPath, $image, 'public');

                $drive = new Drive;
                $drive->table_id = $categoryId;
                $drive->table_type = $path;
                $drive->file_name = $fileName;
                $drive->file_type = 'image';
                $drive->save();
            }

            return redirect('admin/categories/' . $categoryId . '/images')
                ->with('success', __('Category image ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $category = Category::findOrFail($categoryId);

        $drive = Drive::find($id);

        $drives = Drive::where('table_id', $categoryId)
            ->where('table_type', $path)
            ->where('file_type', 'image')
            ->get();

        return view('admin.categories.images')->with(compact('category', 'drive', 'drives'));
    }

    public function metaTags(Request $request, $categoryId)
    {
        $category = Category::findOrFail($categoryId);

        $meta = MetaHeadings::where('table_type', 'category-table')
            ->where('table_id', $categoryId)
            ->first();

        if ($request->isMethod('post')) {
            $rules = [
                'meta_keywords' => 'nullable|string',
                'meta_title' => 'nullable|string|max:255',
                'meta_schema' => 'nullable|string',
                'meta_description' => 'nullable|string|max:1000',
                'og_title' => 'nullable|string|max:255',
                'og_description' => 'nullable|string|max:1000',
                'og_image' => 'nullable|string|max:1024',
                'twitter_card' => ['nullable', Rule::in(['summary', 'summary_large_image', 'app', 'player'])],
                'twitter_title' => 'nullable|string|max:255',
                'twitter_desc' => 'nullable|string|max:1000',
                'twitter_image' => 'nullable|string|max:1024',
            ];

            $validated = $request->validate($rules);

            if (!$meta) {
                $meta = new MetaHeadings();
                $meta->table_type = 'category-table';
                $meta->table_id = $categoryId;
            }

            $meta->meta_title = $validated['meta_title'] ?? null;
            $meta->meta_keywords = $validated['meta_keywords'] ?? null;
            $meta->meta_schema = $validated['meta_schema'] ?? null;
            $meta->meta_description = $validated['meta_description'] ?? null;
            $meta->og_title = $validated['og_title'] ?? null;
            $meta->og_description = $validated['og_description'] ?? null;
            $meta->og_image = $validated['og_image'] ?? null;
            $meta->twitter_image = $validated['twitter_image'] ?? null;
            $meta->twitter_card = $validated['twitter_card'] ?? null;
            $meta->twitter_title = $validated['twitter_title'] ?? null;
            $meta->twitter_desc = $validated['twitter_desc'] ?? null;

            $meta->save();

            return redirect('admin/categories/' . $categoryId . '/meta-headings')
                ->with('success', __('Category meta information saved successfully.'));
        }

        return view('admin.categories.meta-headings', compact('category', 'meta'));
    }


    public function facilities(Request $request, $categoryId, $id = null)
{
    if ($request->isMethod('delete')) {
        $facility = Facility::findOrFail($id);
        $facility->delete();

        return redirect('admin/categories/' . $categoryId . '/facilities')
            ->with('success', __('Category facility deleted successfully.'));
    }

    if ($request->isMethod('post')) {
        $rules = [
            'title' => 'nullable|string|max:255',             // Badge
            'sub_title' => 'nullable|string|max:255',         // Common Title
            'title_description' => 'nullable|string|max:255', // Common Description
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('facilities', 'name')
                    ->where('table_id', $categoryId)
                    ->where('table_type', 'category')
                    ->ignore($id),
            ],
            'description' => 'required|string',
            'icon' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $facility = Facility::findOrNew($id);
        $facility->table_id = $categoryId;
        $facility->table_type = 'category';
        $facility->name = $request->name;
        $facility->value = $request->description;
        $facility->icon = $request->icon;
        $facility->title = $request->title;
        $facility->sub_title = $request->sub_title;
        $facility->bottom_title = $request->title_description;
        $facility->save();

        Facility::where('table_id', $categoryId)
            ->where('table_type', 'category')
            ->update([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'bottom_title' => $request->title_description,
            ]);

        return redirect('admin/categories/' . $categoryId . '/facilities')
            ->with('success', __('Category facility ' . ($id ? 'updated' : 'saved') . ' successfully.'));
    }

    $category = Category::findOrFail($categoryId);
    $facility = Facility::find($id);
    $facilities = Facility::where('table_id', $categoryId)
        ->where('table_type', 'category')
        ->get();

    return view('admin.categories.facilities')->with(compact('category', 'facility', 'facilities'));
}

    /// Content Section 
    public function contentSection(Request $request, $categoryId)
    {
        $category = Category::findOrFail($categoryId);

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'title' => 'required|string',
                'modal_title' => 'required|string',
                'display_block' => 'nullable|string',
                'modal_content' => 'nullable|string',
                'blocks_section_1' => 'array',
                'blocks_section_2' => 'array',
                'cta_title' => 'nullable|string',
                'cta_desc' => 'nullable|string',
            ]);

            CategorySections::updateOrCreate(
            ['category_id' => $categoryId,
            'type' => 'category'],
            [
                'title' => $validated['title'],
                'modal_title' => $validated['modal_title'],
                'display_block' => $validated['display_block'],
                'modal_content' => $validated['modal_content'],
                'blocks_section' => json_encode([
                    'section_1' => $validated['blocks_section_1'],
                    'section_2' => $validated['blocks_section_2'],
                ]), 
                'cta_title' => $validated['cta_title'],
                'cta_desc' => $validated['cta_desc'],
            ]
        );


            return redirect()->back()->with('success', 'Category Section saved successfully.');
        }

        $section = CategorySections::where('category_id', $categoryId)->first();

        return view('admin.categories.content-section', compact('category', 'section'));
    }
}
