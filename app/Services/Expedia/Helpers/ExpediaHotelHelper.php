<?php
namespace App\Services\Expedia\Helpers;

class ExpediaHotelHelper
{
    /**
     * Get full image URL.
     * 
     * @param  string $path
     * @return string
     */
    public function imageUrl($path)
    {
        return env('EXPEDIA_MEDIA_BASE_URL') . $path;
    }
}
