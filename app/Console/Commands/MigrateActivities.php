<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Activities;
use App\Models\MetaHeadings;
use App\Models\Faq;
use App\Models\Review;
use App\Models\Drive;

class MigrateActivities extends Command
{
    protected $signature = 'migrate:activities';
    protected $description = 'Migrate meta, FAQ, review and drive data from services to matching activities';

   public function handle()
{
    $this->info('🚀 Starting migration from services to activities...');
    DB::beginTransaction();

    try {
        $services = Service::where('type', 'activity')->get();
        $activities = Activities::get();
        $idMap = [];

        foreach ($activities as $activity) {
            $matchedService = $services->first(function ($service) use ($activity) {
                return $service->category_id == $activity->category_id && $service->slug == $activity->slug;
            });

            if ($matchedService) {
                $this->info("🔄 Matching service found for Activity ID {$activity->id} (Slug: {$activity->slug})");

                $existingMeta = MetaHeadings::where('table_type', 'activity')
                    ->where('table_id', $activity->id)
                    ->first();

                if (!$existingMeta) {
                    MetaHeadings::create([
                        'table_type' => 'activity',
                        'table_id' => $activity->id,
                        'meta_title' => $matchedService->meta_title ?? null,
                        'meta_keywords' => $matchedService->meta_keywords ?? null,
                        'meta_schema' => $matchedService->meta_schema ?? null,
                        'meta_description' => $matchedService->meta_description ?? null,
                        'og_title' => $matchedService->og_title ?? null,
                        'og_description' => $matchedService->og_description ?? null,
                        'og_image' => $matchedService->og_image ?? null,
                        'twitter_card' => $matchedService->twitter_card ?? null,
                        'twitter_title' => $matchedService->twitter_title ?? null,
                        'twitter_desc' => $matchedService->twitter_desc ?? null,
                        'twitter_image' => $matchedService->twitter_image ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $this->info("✅ MetaHeadings inserted for Activity ID {$activity->id}");
                } else {
                    $this->warn("⚠️ MetaHeadings already exists for Activity ID {$activity->id}, skipping...");
                }

                $idMap[$matchedService->id] = $activity->id;

                $matchedService->delete();
                $this->info("🗑️ Deleted matched Service ID {$matchedService->id}");
            } else {
                $this->warn("❌ No matching service found for Activity ID {$activity->id} (Slug: {$activity->slug})");
            }
        }

        foreach ($idMap as $oldId => $newId) {
            Faq::where('table_id', $oldId)->update(['table_id' => $newId]);
            Review::where('table_id', $oldId)->update(['table_id' => $newId]);
            Drive::where('table_id', $oldId)
                ->where('table_type', 'activity_photo')
                ->update(['table_id' => $newId]);

            $this->info("🔁 Updated related tables for old ID {$oldId} to new Activity ID {$newId}");
        }

        DB::commit();
        $this->info('🎉 Migration completed successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        $this->error('❌ Migration failed: ' . $e->getMessage());
    }
}

}
