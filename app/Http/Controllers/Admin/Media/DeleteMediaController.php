<?php

namespace App\Http\Controllers\Admin\Media;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Product;
use App\Repositories\Admin\Media\MediaRepository;

class DeleteMediaController extends Controller
{
    public function __invoke(Product $product, Media $media, MediaRepository $StoreMediaRequest)
    {
        if (! $StoreMediaRequest->delete($product, $media)) {
            return response()->error('این رسانه متعلق به این محصول نیست.', null, 403);
        }

        return response()->success(null, 'رسانه با موفقیت حذف شد.');
    }
}
