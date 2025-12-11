<?php

namespace App\Http\Controllers\Public\ContactUs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\ContactUs\StoreContactUsRequest;
use App\Repositories\Public\ContactUs\ContactUsRepository;


class ContactUsController extends Controller
{
    public function __invoke(ContactUsRepository $contactUsRepository,StoreContactUsRequest $request)
    {
        $data = $request->validated();
        $result = $contactUsRepository->StoreContact($data);

        if(!$result){
            return response()->error( 'درخواست شما با موفقیت ثبت نشد.', null,400);
        }
        return response()->success('درخواست شما با موفقیت ثبت شد.');
    }
}
