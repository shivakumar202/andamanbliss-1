<?php

namespace App\Console\Commands;

use App\Models\Service;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RemoveHotels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remove-hotels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function handle()
{
    $sourceBase = public_path('storage/team_photo');
    $destinationBase = public_path('storage/team_photo-11');

    if (!File::exists($destinationBase)) {
        File::makeDirectory($destinationBase, 0777, true);
    }

    $items = \App\Models\Team::with('photo')->get();
    echo "Total Teams: " . $items->count() . "\n";

    $count = 0;

    foreach ($items as $item) {
        if ($item->photo) {
            $photo = $item->photo;
            $filePath = $sourceBase . '/' . basename($photo->file_name);
            $destinationPath = $destinationBase . '/' . basename($photo->file_name);

            if (File::exists($filePath)) {
                File::move($filePath, $destinationPath);
                $count++;
                echo "Moved: " . basename($photo->file_name) . "\n";
            } else {
                echo "Missing: {$filePath}\n";
            }
        }
    }

    echo "✅ Total Moved: {$count}\n";
}


}
