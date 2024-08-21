<?php

namespace App\Http\Controllers\Admin\Sale;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractTemplate;
use App\Models\CustomerInfo;
use App\Models\Sale;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class SaleDetailController extends Controller
{
    public function show($id){
        $userId = Auth::id();
        $customer = CustomerInfo::with(['Sale', 'Censor', 'loan'])->where('id', $id)->where('sale', $userId)->first();
        $loans = Sale::where('minIncome', '<=', $customer->income/1000000)->get();
        return view('admin.pages.sale.detail', ['customer' => $customer, 'loans' => $loans]);
    }

    public function confirm($id, Request $request){

        try{
            $userId = Auth::id();
            $customer = CustomerInfo::where('id', $id)->where('sale', $userId)->first();

            $request->validate([
                'selectedLoanId' => 'required|string'
            ]);

            $loan = Sale::find($request->input('selectedLoanId'));

            $contractTemplate = ContractTemplate::find(1);

            $placeholders = [
                '{{name}}',
                '{{cccd}}',
                '{{phone}}',
                '{{loan}}',
                '{{duration}}',
                '{{rate}}'
            ];

            $replacements = [
                $customer->name,
                $customer->idCard,
                $customer->phone,
                $loan->amount,
                $loan->duration,
                $loan->rate
            ];

            $content = str_replace($placeholders, $replacements, $contractTemplate->template);

            $contract = Contract::create([
                'content' => $content
            ]);

            $customer->status = 'FILL';
            $customer->loan_id = $request->input('selectedLoanId');
            $customer->contract_id = $contract->id;
            $customer->call_time = now();
            $customer->save();

            toastr()->success(': Xác nhận thành công');
            return back();
        } catch (ValidationException $e) {
            toastr()->error(': Chưa chọn gói vay cho khách hàng');
            return back();
        }

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

    public function contract($id){
        $userId = Auth::id();
        $customer = CustomerInfo::where('id', $id)->where('sale', $userId)->first();
        $contract = Contract::find($customer->contract_id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($contract->content);
        return $pdf->stream();
    }
}
