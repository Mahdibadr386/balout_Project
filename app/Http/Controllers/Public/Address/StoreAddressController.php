<?php

namespace App\Http\Controllers\Public\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Address\StoreAddressRequest;
use App\Http\Resources\Auth\UserAddressResource;
use App\Interface\AddressRepositoryInterface;
use Illuminate\Http\Request;

class StoreAddressController extends Controller
{
    public function __invoke(AddressRepositoryInterface $AddressRepository , StoreAddressRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $address = $AddressRepository->store($data);

        return response()->success( 'ادرس کاربر با موفقیت اضافه شد',  new UserAddressResource($address) );


    }
}
