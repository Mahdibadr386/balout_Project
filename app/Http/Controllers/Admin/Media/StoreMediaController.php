<?php

namespace App\Http\Controllers\Admin\Media;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Media\StoreMediaRequest;
use App\Http\Resources\Admin\Media\MediaResource;
use App\Models\Product;
use App\Repositories\Admin\Media\MediaRepository;
use Illuminate\Http\Request;

class StoreMediaController extends Controller
{
    public function __invoke(Product $product, StoreMediaRequest $request, MediaRepository $repo)
    {
        $media = $repo->store($product, $request->validated());

        return response()->success(new MediaResource($media), 'رسانه با موفقیت به محصول اضافه شد.' , 200);
    }
}
