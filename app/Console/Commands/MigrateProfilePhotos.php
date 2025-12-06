<?php

namespace App\Console\Commands;

use App\Models\Crm\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MigrateProfilePhotos extends Command
{
    protected $signature = 'photos:migrate-public-to-protected';

    protected $description = 'Move existing profile photos from public/files/profile_photos to storage/app/protected/profile_photos.';

    public function handle(): int
    {
        $publicPath = public_path('files/profile_photos');
        $destDisk = Storage::disk('local');
        $moved = 0;

        if (!File::isDirectory($publicPath)) {
            $this->info('No public profile photos directory found.');
            return self::SUCCESS;
        }

        foreach (File::files($publicPath) as $file) {
            $filename = $file->getFilename();
            if ($filename === 'no_photo.png') {
                continue;
            }

            // Move file
            $contents = File::get($file->getRealPath());
            $destDisk->put('protected/profile_photos/' . $filename, $contents);
            $moved++;
        }

        $this->info("Moved {$moved} files to protected storage.");

        return self::SUCCESS;
    }
}
