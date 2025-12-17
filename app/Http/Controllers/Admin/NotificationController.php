<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Drive;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $notifications = Notifications::with('drive')->orderBy('created_at', 'desc')->get();
        $notification = null;
        return view('admin.notification.index', compact('notifications','notification'));
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
        $rules = [
            'category' => 'required|string',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'category' => 'required|string',
            'action_url' => 'required|url',
            'status' => 'required|in:1,0',
            'visit_url' => 'nullable|url',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $notification = new Notifications();
        $notification->notification_type = 'push';
        $notification->title = $request->title;
        $notification->message = $request->message;
        $notification->action_url = $request->action_url;
        $notification->category = $request->category;
        $notification->status = $request->status;
        $notification->visit_url = $request->visit_url;
        $notification->save();

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $realPath =  $file->getRealPath();
            $extension = $file->getClientOriginalExtension();
            $filename = 'photo-' . date('Ymd-His') . '-' . abs(crc32(uniqid())) . '.' . $extension;
            $fullpath = 'notifications/' . $filename;
            if (Storage::disk('public')->exists($fullpath)) {
                Storage::disk('public')->delete($fullpath);
            }
            $resize_width = 720;
            $resize_height = 480;
            $image = Image::make($realPath);
            $image->resize($resize_width, $resize_height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode($extension);
            Storage::disk('public')->put($fullpath, (string) $image);

            $drive = new Drive;
            $drive->table_id = $notification->id;
            $drive->table_type = 'notifications';
            $drive->file_name = $filename;
            $drive->file_type = 'image/' . $extension;
            $drive->save();
        }
        return back()->with('success', 'Notification created successfully.');
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
        //
        $notification = Notifications::with('drive')->findOrFail($id);
        $notifications = Notifications::with('drive')->orderBy('created_at', 'desc')->get();
        return view('admin.notification.index', compact('notification','notifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         $rules = [
            'category' => 'required|string',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'category' => 'required|string',
            'action_url' => 'required|url',
            'status' => 'required|in:1,0',
            'visit_url' => 'nullable|url',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $notification = Notifications::findOrFail($id);
        $notification->update($request->only(['title','message','action_url','category','status', 'visit_url']));

        if($request->has('banner'))
        {
            if($id)
            {
                $drive = Drive::where('table_id',$id)->where('table_type','notifications')->first();
                if($drive)
                {
                    $existingPath = 'notifications/' . $drive->file_name;
                    if (Storage::disk('public')->exists($existingPath)) {
                        Storage::disk('public')->delete($existingPath);
                    }
                    $drive->delete();
                }

                if(!Storage::disk('public')->exists('notifications')){
                    Storage::disk('public')->makeDirectory('notifications', 0777, true, true);
                }

                $file = $request->file('banner');
                $realPath =  $file->getRealPath();
                $extension = $file->getClientOriginalExtension();
                $filename = 'photo-' . date('Ymd-His') . '-' . abs(crc32(uniqid())) . '.' . $extension;
                $fullpath = 'notifications/' . $filename;
                if (Storage::disk('public')->exists($fullpath)) {
                    Storage::disk('public')->delete($fullpath);
                }
                $resize_width = 720;
                $resize_height = 480;
                $image = Image::make($realPath);
                $image->resize($resize_width, $resize_height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode($extension);
                Storage::disk('public')->put($fullpath, (string) $image);   
                $drive = new Drive;
                $drive->table_id = $notification->id;
                $drive->table_type = 'notifications';
                $drive->file_name = $filename;
                $drive->file_type = 'image/' . $extension;
                $drive->save();
            }

            // Handle banner update logic here
        }

        return redirect()->route('admin.push-notifications.index')->with('success', 'Notification updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        if($id)
        {
            $notification = Notifications::findOrFail($id);
            if($notification)
            {
                $drive = Drive::where('table_id',$id)->where('table_type','notifications')->first();
                if($drive)
                {
                    $existingPath = 'notifications/' . $drive->file_name;
                    if (Storage::disk('public')->exists($existingPath)) {
                        Storage::disk('public')->delete($existingPath);
                    }
                    $drive->delete();
                }
                $notification->delete();
            }
        }
        return redirect()->route('admin.push-notifications.index')->with('success', 'Notification deleted successfully.');
    }
}
