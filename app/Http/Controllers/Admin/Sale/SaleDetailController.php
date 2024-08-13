<?php

namespace App\Http\Controllers\Admin\Sale;

use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SaleDetailController extends Controller
{
    public function show($id){
        $userId = Auth::id();
        $customer = CustomerInfo::with(['Sale', 'Censor'])->where('id', $id)->where('sale', $userId)->first();
        return view('admin.pages.sale.detail', ['customer' => $customer]);
    }

    public function genLink(Request $request){
        try{
            $userId = Auth::id();

            $customer = CustomerInfo::where('id', intval($request->input('id')))->where('sale', $userId)->first();

            $key = env('JWT_SECRET');
            $payload = [
                'customer_id' => $customer->id,
                'v' => 2,
                'exp' => time() + (24 * 60 * 60),
            ];

            $jwt = JWT::encode($payload, $key, 'HS256');

            $link = route('confirm-v2', ['token' => $jwt]);

            $customer->status = 'FILL';

            $customer->save();

            return response()->json(['link' => $link]);
        }
        catch (\Exception $e){
            Log::error($e);
            return response()->json(['error' => 'Error.'], 500);
        }

    }

    public function cancel($id){
        $userId = Auth::id();
        $customer = CustomerInfo::where('id', $id)->where('sale', $userId)->first();
        $customer->status = 'DISABLE';
        $customer->save();
        return back();
    }
}
