<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Sale;
use Illuminate\Http\Request;

class EditLoanController extends Controller
{
    public function show($id){
        $loan = Sale::findOrFail($id);
        $customerImage = Image::where('type', 'sale')->get();
        return view('admin.pages.settings.edit-loan', ['loan' => $loan, 'customerImage' => $customerImage]);
    }

    public function edit($id, Request $request){
        try{
            $request->validate([
                'title' => 'required|string',
                'content' => 'required|string',
                'amount' => 'required|string',
                'duration' => 'required|string',
                'rate' => 'required|string',
                'minIncome' => 'required|string',
            ]);

            $loan = Sale::find($id);

            $loan->title = $request->input('title');
            $loan->content = $request->input('content');
            $loan->amount = $request->input('amount');
            $loan->duration = $request->input('duration');
            $loan->rate = $request->input('rate');
            $loan->minIncome = $request->input('minIncome');

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

                $loan->image = $imagePath;

                $loan->save();

                toastr()->success("Sửa gói vay thành công");
                return redirect(Route('loan-setting'));

            } else if ($request->input('checkbox1') !== null) {
                $request->validate([
                    'selectImage' => 'required'
                ]);

                $loan->image = $request->input('selectImage');

                $loan->save();

                toastr()->success("Sửa gói vay thành công");
                return redirect(Route('loan-setting'));
            }

            toastr()->error("Error");
            return redirect(Route('loan-setting'));
        }
        catch(\Exception $e){
            toastr()->error("Error");
            return redirect(Route('loan-setting'));
        }
    }
}
