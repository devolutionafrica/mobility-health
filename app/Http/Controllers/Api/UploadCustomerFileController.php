<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UploadCustomerFileController extends Controller
{


    public function uploadDocument(Request $request): CustomerResource
    {

        $data = $request->validate([
            "document_type" => "required|string",
            "document_num" => "required|string",
        ]);
        /**
         * @var $customer Customer
         */
        $customer = Auth::user();
        $customer->update($data);

        $recto = $customer->documentRecto;
        /**
         * @var $file UploadedFile
         */
        foreach ($request->file() as $key => $file) {
            $path = $file->store("customer/documents/$key");
            if ($key == "recto") {
                if (is_null($recto)) {
                    $customer->documentRecto()->create(["path" => $path, 'type_ref' => $key]);
                } else {
                    @unlink(storage_path('app/private/' . $recto->path));
                    $recto->path = $path;
                    $recto->save();
                }
            }
        }

        return CustomerResource::make($customer->refresh());
    }

    public function uploadProfilePicture(Request $request): CustomerResource
    {
        /**
         * @var $customer Customer
         */
        $customer = Auth::user();
        $avatar = $customer->avatar;

        /**
         * @var $file UploadedFile
         */
        foreach ($request->file() as $key => $file) {
            $path = $file->store("customer/image/$key");
            if (is_null($avatar)) {
                $customer->avatar()->create(["path" => $path, 'type_ref' => $key]);
            } else {
                @unlink(storage_path('app/private/' . $avatar->path));
                $avatar->path = $path;
                $avatar->save();
            }

            break;
        }

        return CustomerResource::make($customer->refresh());
    }
}
