<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function validate(Request $request){
        try{
            $request->validate([
                'request_id' => 'required|string',
                'contact_number' => 'required|string',
                'national_id' => 'required|string'
            ]);

            $customerInfo = CustomerInfo::where('idCard', $request->input('national_id'))
                ->orWhere('phone', $request->input('contact_number'))
                ->where('status', '!=', "DONE")
                ->first();

            if ($customerInfo) return [
                'rslt_msg' => 'Success',
                'errorMessage' => 'Failure',
                'rslt_cd' => 's',
                'reason_code' => '1'
            ];
            else return [
                'rslt_msg' => 'Success',
                'errorMessage' => 'Failure',
                'rslt_cd' => 's',
                'reason_code' => '0'
            ];
        }
        catch(\Exception $e){
            Log::error($e);
            return [
                'rslt_msg' => 'Failure',
                'errorMessage' => 'Successful',
                'rslt_cd' => 'c',
                'reason_code' => '1'
            ];
        }
    }

    public function genOpt(Request $request){
        try{
            $request->validate([
                'TransId' => 'required|string',
                'phone' => 'required|string',
            ]);

            $otp = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

            $phone = $request->input('phone');

            Cache::put($phone, $otp, 150);

            // send otp code


            //

            return [
                'rslt_msg' => 'Success',
                'errorMessage' => 'Failure',
                'data' => [
                    'result' => [
                        'status' => true,
                        'value' => $otp
                    ]
                ]
            ];
        }
        catch(\Exception $e){
            Log::error($e);
            return [
                'rslt_msg' => 'Failure',
                'errorMessage' => 'Successful',
                'data' => [
                    'result' => [
                        'status' => false,
                        'value' => false
                    ]
                ]
            ];
        }
    }

    public function verify(Request $request){
        try{
            $request->validate([
                'TransId' => 'required|string',
                'phone' => 'required|string',
                'otp' => 'required|string',
            ]);

            $storedOtp = Cache::get($request->input('phone'));

            Log::info($storedOtp);

            Log::info($request->input('otp'));

            if ($storedOtp && $storedOtp == $request->input('otp')) return [
                    'rslt_msg' => 'Success',
                    'errorMessage' => 'Failure',
                    'data' => [
                        'result' => [
                            'status' => true,
                            'value' => true,
                            'authentication' => 'ACCEPT'
                        ]
                    ]
                ];

            return [
                'rslt_msg' => 'Success',
                'errorMessage' => 'Failure',
                'data' => [
                    'result' => [
                        'status' => true,
                        'value' => true,
                        'authentication' => 'FAIL'
                    ]
                ]
            ];
        }
        catch(\Exception $e){
            Log::error($e);
            return [
                'rslt_msg' => 'Failure',
                'errorMessage' => 'Successful',
                'data' => [
                    'result' => [
                        'status' => false,
                        'value' => false
                    ]
                ]
            ];
        }
    }

    public function send(Request $request){
        $request->validate([
            'request_id' => 'required|string',
            'device' => 'required|string',
            'fullname' => 'required|string',
            'contact_number' => 'required|string',
            'note' => 'required|string'
        ]);

        $note = json_decode($request->input('note'));

        $customer_info = CustomerInfo::create([
            'idCard' => $note->cmnd,
            'name' => $request->input('fullname'),
            'phone' => $request->input('contact_number'),
            'salaryType' => $note->income_amount,
            'timeCall' => $note->income,
            'status' => 'PENDING',
        ]);

        return [
            'rslt_msg' => 'Success',
            'errorMessage' => 'Failure',
        ];
    }
}
