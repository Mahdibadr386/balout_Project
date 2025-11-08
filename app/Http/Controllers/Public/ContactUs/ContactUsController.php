<?php

namespace App\Http\Controllers\Public\ContactUs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\ContactUs\StoreContactUsRequest;
use App\Repositories\Public\ContactUs\ContactUsRepository;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    protected $contactUsRepository;

    public function __construct(ContactUsRepository $contactUsRepository)
    {
        $this->contactUsRepository = $contactUsRepository;
    }

    public function __invoke(StoreContactUsRequest $request)
    {
        $data = $request->validated();
        $result = $this->contactUsRepository->StoreContact($data);

        return response()->success(null, 'درخواست شما با موفقیت ثبت شد.', 200);
    }
}
