<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProcessController extends Controller
{
    public function show(){
        $process = Process::all();
        return view('admin.pages.settings.process', ['process' => $process]);
    }

    public function showEdit($id){
        $process = Process::find($id);
        $processImage = Image::where('type', 'process')->get();
        return view('admin.pages.settings.edit-process', ['process' => $process, 'processImage' => $processImage]);
    }

    public function edit($id, Request $request){
        try{
            $request->validate([
                'title' => 'required|string',
                'content' => 'required|string',
            ]);

            $process = Process::find($id);

            $process->title = $request->input('title');
            $process->content = $request->input('content');

            if ($request->input('checkbox2') !== null) {
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);
                $image = $request->file('image');

                $originalName = $image->getClientOriginalName();
                $imageName = time().'.'.$image->getClientOriginalExtension();

                $image->storeAs("images/process", $imageName, 'public');

                $imagePath = "/storage/images/process/{$imageName}";

                $imageModel = new Image();
                $imageModel->file = $imagePath;
                $imageModel->filename = $originalName;
                $imageModel->type = 'process';
                $imageModel->save();

                $process->image = $imagePath;

                $process->save();

                toastr()->success("Sửa thành công");
                return redirect(Route('process-setting'));

            } else if ($request->input('checkbox1') !== null) {
                $request->validate([
                    'selectImage' => 'required|string'
                ]);

                $process->image = $request->input('selectImage');

                $process->save();

                toastr()->success("Sửa đánh giá thành công");
                return redirect(Route('process-setting'));
            }

            toastr()->error("Error");
            return redirect(Route('process-setting'));
        }
        catch(\Exception $e){
            toastr()->error("Error");
            Log::error($e);
            return redirect(Route('process-setting'));
        }
    }
}
