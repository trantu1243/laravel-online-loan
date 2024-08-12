<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(){
        $users = User::where('role', '!=', 'ADMIN')->get();
        return view('admin.pages.user.index', ['users' => $users]);
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $name = $user->name;
        $user->delete();
        toastr()->success("Xóa {$name} thành công");
        return back();
    }
}
