<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Censor\CensorController;
use App\Http\Controllers\Admin\Censor\CensorDetailController;
use App\Http\Controllers\Admin\Censor\ReminderController;
use App\Http\Controllers\Admin\Contract\ContractTemplateController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EditCustomerInfoController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\Pdf\PdfController;
use App\Http\Controllers\Admin\Sale\SaleController;
use App\Http\Controllers\Admin\Sale\SaleDetailController;
use App\Http\Controllers\Admin\Setting\CodeController;
use App\Http\Controllers\Admin\Setting\CustomerController;
use App\Http\Controllers\Admin\Setting\EditLoanController;
use App\Http\Controllers\Admin\Setting\FormController;
use App\Http\Controllers\Admin\Setting\GeneralSettingController;
use App\Http\Controllers\Admin\Setting\LoanSettingController;
use App\Http\Controllers\Admin\User\AddUserController;
use App\Http\Controllers\Admin\User\ChangePasswordController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\LinkController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ApiMiddleware;
use App\Http\Middleware\AppraiserMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\SaleMiddleware;
use App\Http\Middleware\VerifyMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'show'])->name('index');

Route::get('/customer/confirm-contract/{token}', [LinkController::class, 'show'])->name('confirm-v2');
Route::get('/customer/contract/{token}', [LinkController::class, 'contract'])->name('view-contract');
Route::post('/customer/confirm-contract/{token}', [LinkController::class, 'confirm'])->name('post-confirm-v2');

Route::get('/customer/update-info/{token}', [LinkController::class, 'showV3'])->name('update-v2');
Route::post('/customer/update-info/{token}', [LinkController::class, 'update'])->name('post-update-v2');

Route::middleware([AuthMiddleware::class])->group(function (){
    Route::get('/admin/login', [LoginController::class, 'show'])->name('auth.login');
    Route::post('/admin/login', [LoginController::class, 'login'])->name('auth.post.login');
});

Route::middleware([VerifyMiddleware::class])->group(function (){


    // Admin
    Route::middleware([AdminMiddleware::class])->group(function (){
        Route::get('/admin', [DashboardController::class, 'show'])->name('dashboard');
        Route::get('/admin/edit/{id}', [EditCustomerInfoController::class, 'show'])->name('edit-customer-info');
        Route::post('/admin/edit/{id}', [EditCustomerInfoController::class, 'edit'])->name('post.edit-customer-info');
        Route::delete('/admin/delete/{id}', [DashboardController::class, 'destroy'])->name('delete-customer-info');

        Route::get('/admin/user', [UserController::class, 'show'])->name('show-user');

        Route::get('/admin/add-user', [AddUserController::class, 'show'])->name('add-user');
        Route::post('/admin/add-user', [AddUserController::class, 'create'])->name('post.add-user');

        Route::get('/admin/user/change-password/{id}', [ChangePasswordController::class, 'show'])->name('change-password');
        Route::post('/admin/user/change-password/{id}', [ChangePasswordController::class, 'change'])->name('post.change-password');

        Route::delete('/admin/delete-user/{id}', [UserController::class, 'destroy'])->name('delete-user');

        Route::get('/admin/setting', [GeneralSettingController::class, 'show'])->name('settings');
        Route::post('/admin/setting/upload-image', [GeneralSettingController::class, 'upload'])->name('upload-image');
        Route::post('/admin/setting/general', [GeneralSettingController::class, 'save'])->name('save-setting');

        Route::get('/admin/setting/loan', [LoanSettingController::class, 'show'])->name('loan-setting');
        Route::post('/admin/setting/add-loan', [LoanSettingController::class, 'add'])->name('add-loan');
        Route::delete('/admin/delete-loan/{id}', [LoanSettingController::class, 'destroy'])->name('delete-loan');
        Route::get('/admin/setting/edit-loan/{id}', [EditLoanController::class, 'show'])->name('edit-loan');
        Route::post('/admin/setting/edit-loan/{id}', [EditLoanController::class, 'edit'])->name('post.edit-loan');
        Route::post('/api/loan/update-status/{id}', [LoanSettingController::class, 'active']);

        Route::get('admin/setting/customer', [CustomerController::class, 'show'])->name('customer-setting');
        Route::get('/admin/setting/edit-customer/{id}', [CustomerController::class, 'showEdit'])->name('edit-customer');
        Route::post('/admin/setting/edit-customer/{id}', [CustomerController::class, 'edit'])->name('post.edit-customer');

        Route::get('/admin/setting/code', [CodeController::class, 'show'])->name('show-code');
        Route::get('/admin/setting/others', [CodeController::class, 'showOthers'])->name('show-others');
        Route::post('/admin/setting/code', [CodeController::class, 'change'])->name('save-code');
        Route::post('/admin/setting/others', [CodeController::class, 'changeOthers'])->name('save-others');

        Route::get('/admin/setting/form', [FormController::class, 'show'])->name('form-setting');
        Route::post('/admin/setting/form', [FormController::class, 'add'])->name('add-form');
        Route::delete('/admin/setting/delete-form/{id}', [FormController::class, 'destroy'])->name('delete-form');

        // contract
        Route::get('/admin/contract-template', [ContractTemplateController::class, 'show'])->name('contract-template');
        Route::post('/admin/contract-template', [ContractTemplateController::class, 'save'])->name('save-contract-template');

        Route::post('/admin/dieukhoan', [ContractTemplateController::class, 'dieukhoan'])->name('save-dieukhoan');

        //export
        Route::get('/admin/export/customer-info', [ExportController::class, 'export'])->name('export-customer');
    });

    // Sale
    Route::middleware([SaleMiddleware::class])->group(function (){
        Route::get('/admin/sale', [SaleController::class, 'show'])->name('show-sale');
        Route::post('/admin/sale/{id}', [SaleController::class, 'call'])->name('call-sale');

        Route::get('/admin/sale/detail/{id}', [SaleDetailController::class, 'show'])->name('detail-sale');
        Route::post('/admin/sale/confirm/{id}', [SaleDetailController::class, 'confirm'])->name('confirm-sale');
        Route::post('/admin/gen-link', [SaleDetailController::class, 'genLink'])->name('gen-link');
        Route::post('/admin/sale/disable/{id}', [SaleDetailController::class, 'cancel'])->name('cancel-customer');

        Route::get('/admin/sale/generate-contract/{id}', [SaleDetailController::class, 'contract'])->name('sale-contract');
    });

    // Censor
    Route::middleware([AppraiserMiddleware::class])->group(function (){
        Route::get('/admin/censor', [CensorController::class, 'show'])->name('show-censor');
        Route::post('/admin/censor/{id}', [CensorController::class, 'browse'])->name('browse-censor');

        Route::get('/admin/censor/detail/{id}', [CensorDetailController::class, 'show'])->name('detail-censor');
        Route::post('/admin/censor/browse/{id}', [CensorDetailController::class, 'browse'])->name('browse');
        Route::post('/admin/censor/confirm/{id}', [CensorDetailController::class, 'confirm'])->name('confirm-transfer');
        Route::post('/admin/censor/disable/{id}', [CensorDetailController::class, 'cancel'])->name('censor-cancel');

        Route::get('/admin/censor/reminder', [ReminderController::class, 'show'])->name('show-reminder');
        Route::post('/admin/censor/reminder/{id}', [ReminderController::class, 'remind'])->name('post-reminder');
        Route::post('/admin/censor/transfer/{id}', [ReminderController::class, 'transfer'])->name('transfer-reminder');
        Route::post('/admin/censor/transfer2/{id}', [ReminderController::class, 'transfer2'])->name('transfer2-reminder');

    });

    Route::get('/admin/logout', [LoginController::class, 'logout']);
});

// api
Route::middleware([ApiMiddleware::class])->group(function (){
    Route::post('/api/lead/validate', [ApiController::class, 'validate']);
    Route::post('/api/otp/gen-otp', [ApiController::class, 'genOpt']);
    Route::post('/api/otp/verify-otp', [ApiController::class, 'verify']);
    Route::post('/api/lead/send', [ApiController::class, 'send']);
});

// pdf
Route::get('/dieu-khoan/dieu-khoan-xu-ly-du-lieu-ca-nhan', [PdfController::class, 'dk_xu_ly_du_lieu_ca_nhan']);
Route::get('/dieu-khoan/dieu-khoan-giao-dich', [PdfController::class, 'dk_giao_dich']);
