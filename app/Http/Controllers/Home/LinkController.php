<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Contract;
use App\Models\CustomerInfo;
use App\Models\CustomerInfoV2;
use App\Models\FooterInfo;
use App\Models\Question;
use App\Models\Setting;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LinkController extends Controller
{
    public function show($token){

        try {
            $key = env('JWT_SECRET');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            if ($decoded->v != 2) return response()->json(['error' => 'Invalid token.'], 401);

            $customerId = $decoded->customer_id;

            $user = CustomerInfo::findOrFail($customerId);
            $setting = Setting::find(1);
            $code = Code::find(1);
            $questions = Question::all();
            $footer = FooterInfo::find(1);

            return view('link-v2', [
                'token' => $token,
                'setting' => $setting,
                'code' => $code,
                'questions' => $questions,
                'footer' => $footer

            ]);

        } catch (ExpiredException $e) {
            return response()->json(['error' => 'Link has expired.'], 401);
        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid token.'], 401);
        }
    }

    public function contract($token){
        try {
            $key = env('JWT_SECRET');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            if ($decoded->v != 2) return response()->json(['error' => 'Invalid token.'], 401);

            $customerId = $decoded->customer_id;

            $customer = CustomerInfo::findOrFail($customerId);
            $contract = Contract::find($customer->contract_id);
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($contract->content);
            return $pdf->stream();

        } catch (ExpiredException $e) {
            return response()->json(['error' => 'Link has expired.'], 401);
        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid token.'], 401);
        }
    }

    public function storeImage($image, $type)
    {
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs("images/{$type}", $imageName, 'public');
        $imagePath = "/storage/images/{$type}/{$imageName}";

        return $imagePath;
    }

    public function confirm($token, Request $request){
        try {
            $key = env('JWT_SECRET');

            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            if ($decoded->v != 2) {
                toastr()->error(' Error');
                return back();
            }
            $customerId = $decoded->customer_id;

            $customer = CustomerInfo::findOrFail($customerId);

            $request->validate([
                'confirm_e_contact' => 'required|string',
                'i_agree_terms_and_conditions'  => 'required|string',
            ]);

            $payload = [
                'customer_id' => $customerId,
                'v' => 3,
                'exp' => time() + (24 * 60 * 60),
            ];

            $jwt = JWT::encode($payload, $key, 'HS256');

            $link = route('update-v2', ['token' => $jwt]);

            return redirect($link);
        }
        catch (ExpiredException $e) {
            return response()->json(['error' => 'Link has expired.'], 401);
        } catch (Exception $e) {
            Log::error($e);
            toastr()->error(' Error');
            return back();
        }
    }

    public function showV3($token){

        try {
            $key = env('JWT_SECRET');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            if ($decoded->v != 3) return response()->json(['error' => 'Invalid token.'], 401);

            $customerId = $decoded->customer_id;

            $user = CustomerInfo::findOrFail($customerId);
            $setting = Setting::find(1);
            $code = Code::find(1);

            $questions = Question::all();
            $footer = FooterInfo::find(1);


            return view('link-v3', [
                'token' => $token,
                'setting' => $setting,
                'code' => $code,
                'questions' => $questions,
                'footer' => $footer

            ]);

        } catch (ExpiredException $e) {
            return response()->json(['error' => 'Link has expired.'], 401);
        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid token.'], 401);
        }
    }

    public function update($token, Request $request){
        try{
            $key = env('JWT_SECRET');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            if ($decoded->v != 3) {
                toastr()->error(' Error');
                return back();
            }
            $customerId = $decoded->customer_id;

            $customer = CustomerInfo::findOrFail($customerId);

            if ($customer->status == 'DONE' || $customer->status == 'TRANSFER') {
                toastr()->success(' Thông tin đã đc ghi nhận tại hệ thống');
                return redirect(route('index'));
            }

            $request->validate([
                'frontCCCD' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'backCCCD' => 'required|image|mimes:jpeg,png,jpg,gif,svg,pdf',
                'salary_slip.*' => 'required|file|mimes:pdf,jpg,png,doc,docx',
                'employment_contract.*' => 'required|file|mimes:pdf,jpg,png,doc,docx',
                'faceData' => [
                    'required',
                    'regex:/^data:image\/(png|jpg|jpeg|gif);base64,/',
                ],
            ]);

            // frontCCCD
            $frontCCCD = $this->storeImage($request->file('frontCCCD'), 'frontCCCD');

            //backCCCD
            $backCCCD = $this->storeImage($request->file('backCCCD'), 'backCCCD');

            // salary_slip
            $salary_slips = [];
            foreach ($request->file('salary_slip') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('files/salary_slips', $fileName, 'public');
                $salary_slips[] = "/storage/files/salary_slips/{$fileName}";
            }

            // employment_contract
            $employment_contract = [];
            foreach ($request->file('employment_contract') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('files/employment_contracts', $fileName, 'public');
                $employment_contract[] = "/storage/files/employment_contracts/{$fileName}";
            }

            // face image
            $base64Image = $request->input('faceData');

            list($type, $data) = explode(';', $base64Image);
            list(, $data) = explode(',', $data);

            $imageData = base64_decode($data);
            $extension = explode('/', mime_content_type($base64Image))[1];

            $imageName = uniqid() . '.' . $extension;

            $filePath = "images/face/{$imageName}";

            Storage::disk('public')->put($filePath, $imageData);

            $faceData = "/storage/{$filePath}";

            $customer_info_v2 = CustomerInfoV2::where('customer_info_id', $customer->id)->first();

            if ($customer_info_v2) {
                $customer_info_v2->update([
                    'customer_info_id' => $customer->id,
                    'frontCCCD' => $frontCCCD,
                    'backCCCD' => $backCCCD,
                    'salary_slip' => json_encode($salary_slips),
                    'employment_contract' => json_encode($employment_contract),
                    'faceData' => $faceData,
                    'confirm' => true,
                    'accept' =>true
                ]);
            } else {
                $customer_info_v2 = CustomerInfoV2::create([
                    'customer_info_id' => $customer->id,
                    'frontCCCD' => $frontCCCD,
                    'backCCCD' => $backCCCD,
                    'salary_slip' => json_encode($salary_slips),
                    'employment_contract' => json_encode($employment_contract),
                    'faceData' => $faceData,
                    'confirm' => true,
                    'accept' =>true
                ]);
            }

            $customer->status = 'CENSOR';
            $customer->fill_time = now();
            $customer->save();

            toastr()->success(' Đã update thông tin thành công');
            return redirect(route('index'));
        } catch (ExpiredException $e) {
            return response()->json(['error' => 'Link has expired.'], 401);
        } catch (Exception $e) {
            Log::error($e);
            toastr()->error(' Error');
            return back();
        }

    }
}
