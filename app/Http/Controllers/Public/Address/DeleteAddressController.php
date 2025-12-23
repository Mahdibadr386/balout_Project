<?php

namespace App\Http\Controllers\Public\Address;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserAddressResource;
use App\Interface\AddressRepositoryInterface;
use Illuminate\Http\Request;

class DeleteAddressController extends Controller
{
    public function __invoke(AddressRepositoryInterface $AddressRepository , $id)
    {
        $address = $AddressRepository->delete($id , auth()->id());

        return response()->success( 'ادرس کاربر با موفقیت حذف شد' );

    }
}
