<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Sale;
use Illuminate\Http\Request;

class LoanSettingController extends Controller
{
    public function show(){
        $loans = Sale::paginate(10);
        $customerImage = Image::where('type', 'sale')->get();
        return view('admin.pages.settings.loan', ['loans' => $loans, 'customerImage' => $customerImage]);
    }

    public function add(Request $request){
        try{
            $request->validate([
                'title' => 'required|string',
                'content' => 'required|string',
                'amount' => 'required|string',
                'duration' => 'required|string',
                'rate' => 'required|string',
                'minIncome' => 'required|string',
            ]);

            $loan = [];

            $loan['title'] = $request->input('title');
            $loan['content'] = $request->input('content');
            $loan['amount'] = $request->input('amount');
            $loan['duration'] = $request->input('duration');
            $loan['rate'] = $request->input('rate');
            $loan['minIncome'] = $request->input('minIncome');
            $loan['status'] = false;

            if ($request->input('checkbox2') !== null) {
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);
                $image = $request->file('image');

                $originalName = $image->getClientOriginalName();
                $imageName = time().'.'.$image->getClientOriginalExtension();

                $image->storeAs("images/sale", $imageName, 'public');

                $imagePath = "/storage/images/sale/{$imageName}";

                $imageModel = new Image();
                $imageModel->file = $imagePath;
                $imageModel->filename = $originalName;
                $imageModel->type = 'sale';
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
