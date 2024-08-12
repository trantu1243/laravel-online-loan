<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Sale;
use Illuminate\Http\Request;

class LoanSettingController extends Controller
{
    public function show(){
        $loans = Sale::all();
        $customerImage = Image::where('type', 'sale')->get();
        return view('admin.pages.settings.loan', ['loans' => $loans, 'customerImage' => $customerImage]);
    }

    public function add(Request $request){
        try{
            $request->validate([
                'title' => 'required',
                'content' => 'required',
                'loan' => 'required',
                'rate' => 'required',
                'period' => 'required',
            ]);

            $loan = [];

            $loan['title'] = $request->input('title');
            $loan['content'] = $request->input('content');
            $loan['loan'] = $request->input('loan');
            $loan['rate'] = floatval($request->input('rate'));
            $loan['period'] = $request->input('period');
            $loan['status'] = false;

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

                $loan['image'] = $imagePath;

                Sale::create($loan);

                toastr()->success("Thêm gói vay thành công");
                return back();

            } else if ($request->input('checkbox1') !== null) {
                $request->validate([
                    'selectImage' => 'required'
                ]);

                $loan['image'] = $request->input('selectImage');

                Sale::create($loan);

                toastr()->success("Thêm gói vay thành công");
                return back();
            }

            toastr()->error("Error");
            return back();
        }
        catch(\Exception $e){
            toastr()->error("Error");
            return back();
        }

    }

    public function destroy($id){
        $loan = Sale::findOrFail($id);
        $loan->delete();
        toastr()->success('Xóa gói vay thành công');
        return back();
    }

    public function active($id, Request $request){
        $loan = Sale::findOrFail($id);
        $loan->status = $request->input('status');
        $loan->save();
        return response()->json(['success' => true]);
    }
}
