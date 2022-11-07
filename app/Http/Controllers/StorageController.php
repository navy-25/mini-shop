<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function categoryThumbnail($filename)
    {
        return Storage::disk('public')->response(config('constants.path.storage.category.thumbnail') . $filename);
    }
    public function productThumbnail($filename)
    {
        return Storage::disk('public')->response(config('constants.path.storage.product.thumbnail') . $filename);
    }
    public function settingLogo($filename)
    {
        return Storage::disk('public')->response(config('constants.path.storage.settings.logo') . $filename);
    }
    public function bannerImage($filename)
    {
        return Storage::disk('public')->response(config('constants.path.storage.banner.image') . $filename);
    }
}
