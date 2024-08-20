<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Advantage;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdvantageController extends Controller
{
    public function show(){
        $advantage = Advantage::all();
        return view('admin.pages.settings.advantage', ['advantage' => $advantage]);
    }

    public function showEdit($id){
        $advantage = Advantage::find($id);
        $advantageImage = Image::where('type', 'advantage')->get();
        return view('admin.pages.settings.edit-advantage', ['advantage' => $advantage, 'advantageImage' => $advantageImage]);
    }

    public function edit($id, Request $request){
        try{
            $request->validate([
                'content' => 'required|string',
            ]);

            $advantage = Advantage::find($id);

            $advantage->content = $request->input('content');

            if ($request->input('checkbox2') !== null) {
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);
                $image = $request->file('image');

                $originalName = $image->getClientOriginalName();
                $imageName = time().'.'.$image->getClientOriginalExtension();

                $image->storeAs("images/advantage", $imageName, 'public');

                $imagePath = "/storage/images/advantage/{$imageName}";

                $imageModel = new Image();
                $imageModel->file = $imagePath;
                $imageModel->filename = $originalName;
                $imageModel->type = 'advantage';
                $imageModel->save();

                $advantage->image = $imagePath;

                $advantage->save();

                toastr()->success("Sửa thành công");
                return redirect(Route('advantage-setting'));

            } else if ($request->input('checkbox1') !== null) {
                $request->validate([
                    'selectImage' => 'required|string'
                ]);

                $advantage->image = $request->input('selectImage');

                $advantage->save();

                toastr()->success("Sửa thành công");
                return redirect(Route('advantage-setting'));
            }

            toastr()->error("Error");
            return redirect(Route('advantage-setting'));
        }
        catch(\Exception $e){
            toastr()->error("Error");
            Log::error($e);
            return redirect(Route('advantage-setting'));
        }
    }
}
