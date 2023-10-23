<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        JsonResource::withoutWrapping();
        Validator::extend('base64image', function ($attribute, $value, $parameters, $validator) {
            $base64Image = substr($value, strpos($value, ',') + 1);
            $imageData = base64_decode($base64Image);

            // Check if the decoded data is a valid image
            $finfo = finfo_open();
            $mime = finfo_buffer($finfo, $imageData, FILEINFO_MIME_TYPE);
            finfo_close($finfo);

            return $mime !== false && strpos($mime, 'image/') === 0;
        });
    }
}
