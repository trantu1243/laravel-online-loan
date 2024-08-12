<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;

class CustomerController extends Controller
{
    public function show(){
        $customers = Customer::all();
        return view('admin.pages.settings.customer', ['customers' => $customers]);
    }

    public function showEdit($id){
        $customer = Customer::find($id);
        $customerImage = Image::where('type', 'customer')->get();
        return view('admin.pages.settings.edit-customer', ['customer' => $customer, 'customerImage' => $customerImage]);

    }

    public function edit($id, Request $request){
        try{
            $request->validate([
                'name' => 'required',
                'career' => 'required',
                'content' => 'required',
            ]);

            $customer = Customer::find($id);

            $customer->name = $request->input('name');
            $customer->career = $request->input('career');
            $customer->content = $request->input('content');

            if ($request->input('checkbox2') !== null) {
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);
                $image = $request->file('image');

                $originalName = $image->getClientOriginalName();
                $imageName = time().'.'.$image->getClientOriginalExtension();

                $image->storeAs("images/customer", $imageName, 'public');

                $imagePath = "/storage/images/customer/{$imageName}";

                $imageModel = new Image();
                $imageModel->file = $imagePath;
                $imageModel->filename = $originalName;
                $imageModel->type = 'customer';
                $imageModel->save();

                $customer->image = $imagePath;

                $customer->save();

                toastr()->success("Sửa đánh giá thành công");
                return redirect(Route('customer-setting'));

            } else if ($request->input('checkbox1') !== null) {
                $request->validate([
                    'selectImage' => 'required'
                ]);

                $customer->image = $request->input('selectImage');

                $customer->save();

                toastr()->success("Sửa đánh giá thành công");
                return redirect(Route('customer-setting'));
            }

            toastr()->error("Error");
            return redirect(Route('customer-setting'));
        }
        catch(\Exception $e){
            toastr()->error("Error");
            Log::error($e);
            return redirect(Route('customer-setting'));
        }
    }
}
