<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Category;
use App\Models\TourPackages;
use App\Models\Facility;
use App\Models\Faq;
use App\Models\Review;
use App\Models\Drive;

class MigrateTours extends Command
{
    protected $signature = 'migrate:tours';
    protected $description = 'Migrate services of type "tour" to TourPackages';

    public function handle()
    {
        $this->info('Starting migration from services to tour_packages...');

        DB::beginTransaction();

        try {
            $idMap = [];

            $services = Service::where('type', 'tour')->get();

            foreach ($services as $service) {
                $categoryId = Category::where('id', $service->category_id)
                    ->where('type', 'tour')
                    ->value('id') ?? 1;

                $tour = TourPackages::create([
                    'package_name'   => $service->name,
                    'category_id'    => $categoryId,
                    'nights'         => 0,
                    'days'           => 1,
                    'url'            => '',
                    'cta_title'      => '',
                    'cta_description'=> '',
                    'package_cost'   => $service->adult_price ?? 0,
                    'discount'       => 0,
                    'sub_category_id'=> null,
                    'page_heading'   => $service->name,
                    'description'    => $service->description,
                    'islands_covered'=> $service->address,
                    'slug'           => $service->slug,
                    'reviews'        => $service->ratings ?? 0,
                    'featured'       => 1,
                    'best_seller'    => 1,
                    'status'         => 1,
                ]);

                $idMap[$service->id] = $tour->id;
            }

            foreach ($idMap as $oldId => $newId) {
                Facility::where('table_id', $oldId)->update(['table_id' => $newId]);
                Faq::where('table_id', $oldId)->update(['table_id' => $newId]);
                Review::where('table_id', $oldId)->update(['table_id' => $newId]);
                Drive::where('table_id', $oldId)
                    ->where('table_type', 'tour_photo')
                    ->update(['table_id' => $newId]);
            }

            DB::commit();
            $this->info('Tour migration completed successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->error('Migration failed: ' . $e->getMessage());
        }
    }
}
