<?php

namespace App\Http\Controllers\Public\Address;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserAddressResource;
use App\Http\Resources\Auth\UserResource;
use App\Interface\AddressRepositoryInterface;
use Illuminate\Http\Request;

class IndexAddressController extends Controller
{
    public function __invoke(AddressRepositoryInterface $AddressRepository)
    {
        $address = $AddressRepository->allForUser(auth()->id());
        return response()->success( 'ادرس های کاربر با موفقیت دریافت شد',UserAddressResource::collection($address) );
    }
}
