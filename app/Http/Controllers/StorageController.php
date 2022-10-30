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
}
