<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GeneralSettingController extends Controller
{
    public function show(){
        $setting = Setting::find(1);
        $logo = Image::query()->where('type', 'logo')->select('file', 'filename', 'type')->get();
        $background = Image::query()->where('type', 'background')->select('file', 'filename', 'type')->get();
        $mb_background = Image::query()->where('type', 'mb_background')->select('file', 'filename', 'type')->get();
        $pc_banner = Image::query()->where('type', 'pc_banner')->select('file', 'filename', 'type')->get();
        $mobile_banner = Image::query()->where('type', 'mobile_banner')->select('file', 'filename', 'type')->get();
        $popup = Image::query()->where('type', 'popup')->select('file', 'filename', 'type')->get();
        $about = Image::query()->where('type', 'about')->select('file', 'filename', 'type')->get();
        $logo_footer = Image::query()->where('type', 'logo_footer')->select('file', 'filename', 'type')->get();
        $mb_logo_footer = Image::query()->where('type', 'mb_logo_footer')->select('file', 'filename', 'type')->get();
        $mb_about_image = Image::query()->where('type', 'mb_about_image')->select('file', 'filename', 'type')->get();

        $footer_bg = Image::query()->where('type', 'footer_bg')->select('file', 'filename', 'type')->get();
        $mb_footer_bg = Image::query()->where('type', 'mb_footer_bg')->select('file', 'filename', 'type')->get();
        $popup_button = Image::query()->where('type', 'popup_button')->select('file', 'filename', 'type')->get();


        return view('admin.pages.settings.index', [
            'setting' => $setting,
            'logo' => $logo,
            'background' => $background,
            'mb_background' => $mb_background,
            'pc_banner' => $pc_banner,
            'mobile_banner' => $mobile_banner,
            'popup' => $popup,
            'about' => $about,
            'logo_footer' => $logo_footer,
            'mb_logo_footer' => $mb_logo_footer,
            'mb_about_image' => $mb_about_image,
            'footer_bg' => $footer_bg,
            'mb_footer_bg' => $mb_footer_bg,
            'popup_button' => $popup_button
        ]);
    }

    public function upload(Request $request)
    {

        try{
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'type' => 'required'
            ]);


            $image = $request->file('image');
            $type = $request->input('type');

            $originalName = $image->getClientOriginalName();
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->storeAs("images/{$type}", $imageName, 'public');

            $imagePath = "/storage/images/{$type}/{$imageName}";

            $imageModel = new Image();
            $imageModel->file = $imagePath;
            $imageModel->filename = $originalName;
            $imageModel->type = $type;
            $imageModel->save();

            toastr()->success('Upload ảnh thành công');
            return back();
        }
        catch(\Exception $e){
            Log::error($e);
            Log::error($e->getLine());
            toastr()->error('Failed');
            return back();
        }

    }


    public function save(Request $request){
        try{
            $request->validate([
                'title' => 'required|string',
                'logo' => 'required|string',
                'background' => 'required|string',
                'mb_background' => 'required|string',
                'pc_banner' => 'required|string',
                'mobile_banner' => 'required|string',
                'popup_image' => 'required|string',
                'detail_link' => 'required|string',
                'rate' => 'required|string',
                'about1' =>'required|string',
                'about2' => 'required|string',
                'about_image' => 'required|string',
                'logo_footer' => 'required|string',
                'mb_logo_footer' => 'required|string',
                'dieu_khoan_xu_ly_du_lieu_ca_nhan' => 'required|string',
                'dieu_khoan_giao_dich' => 'required|string',
                'mb_about_image' => 'required|string',
                'hotline' => 'required|string',
                'link_mes' => 'required|string',
                'footer_bg' => 'required|string',
                'mb_footer_bg' => 'required|string',
                'color' => 'required|string',
                'bg_color' => 'required|string',
                'line_color' => 'required|string',
                'popup_button'  => 'required|string',
            ]);

            $setting = Setting::find(1);
            $setting->title = $request->input('title');
            $setting->logo = $request->input('logo');
            $setting->background = $request->input('background');
            $setting->mb_background = $request->input('mb_background');
            $setting->pc_banner = $request->input('pc_banner');
            $setting->mobile_banner = $request->input('mobile_banner');
            $setting->popup = $request->input('popup') !== null;
            $setting->popup_image = $request->input('popup_image');
            $setting->detail_link = $request->input('detail_link');
            $setting->rate = $request->input('rate');
            $setting->about1 = $request->input('about1');
            $setting->about2 = $request->input('about2');
            $setting->about_image = $request->input('about_image');
            $setting->logo_footer = $request->input('logo_footer');
            $setting->dieu_khoan_xu_ly_du_lieu_ca_nhan = $request->input('dieu_khoan_xu_ly_du_lieu_ca_nhan');
            $setting->dieu_khoan_giao_dich = $request->input('dieu_khoan_giao_dich');
            $setting->mb_logo_footer = $request->input('mb_logo_footer');
            $setting->mb_about_image = $request->input('mb_about_image');
            $setting->footer_bg = $request->input('footer_bg');
            $setting->mb_footer_bg = $request->input('mb_footer_bg');
            $setting->color = $request->input('color');
            $setting->bg_color = $request->input('bg_color');
            $setting->line_color = $request->input('line_color');
            $setting->popup_button = $request->input('popup_button');

            $setting->save();

            toastr()->success('Lưu thành cồng');
            return back();
        }
        catch(\Exception $e){
            toastr()->error('Error');
            return back();
        }

    }
}
