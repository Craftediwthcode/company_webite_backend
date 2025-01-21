<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class Helper
{
    /**
     * Uploads an image file to the given directory, optionally resizing it
     * to the given height and width while maintaining aspect ratio.
     *
     * @param  mixed  $file The file to upload, either as a Symfony UploadedFile
     *                      instance or as a raw file input.
     * @param  string  $directory The directory to upload to, relative to the
     *                             public path.
     * @param  int|null  $height The height to resize to, or null to skip resizing.
     * @param  int|null  $width The width to resize to, or null to skip resizing.
     * @return string The filename of the uploaded file.
     */
    public static function imageUpload($file, string $directory): string
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = public_path($directory);
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        $file->move($path, $filename);
        return $filename;
    }

    /**
     * Get the URL of the image at the given path.
     *
     * If the given image is null or empty, the URL of the placeholder image
     * will be returned instead.
     *
     * @param  string  $path The path to the image, relative to the public path.
     * @param  string|null  $image The filename of the image, or null if the image doesn't exist.
     * @return string The URL of the image, or the placeholder image if $image is null or empty.
     */
    public static function getImageUrl($image)
    {
        return $image ? URL::asset("$image") : URL::asset('assets/placeholder.jpg');
    }
    public static function  getSupportContact()
    {
        return [
            'address' => Setting::where('key', 'address')->value('value') ?? 'NA',
            'email' => Setting::where('key', 'email')->value('value') ?? 'NA',
            'phone' => Setting::where('key', 'phone')->value('value') ?? 'NA',
            'facebook_url' => Setting::where('key', 'facebook_url')->value('value') ?? 'NA',
            'instagram_url' => Setting::where('key', 'instagram_url')->value('value') ?? 'NA',
            'linkedin_url' => Setting::where('key', 'linkedin_url')->value('value') ?? 'NA'
        ];
    }
}
