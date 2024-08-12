<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddUserController extends Controller
{
    public function show(){
        return view('admin.pages.user.add-user');
    }

    public function create(CreateUserRequest $request){
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request -> input('role'),
        ]);
        toastr()->success('Tạo user thành công');
        return redirect(route('show-user'));
    }
}
