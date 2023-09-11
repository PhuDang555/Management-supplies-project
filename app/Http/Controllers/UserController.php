<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tables\Users;
use App\Tables\XoaUser;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $this->authorize('employee_access');

        return view('users.index',[
            'users' => Users::class,
        ]);
        /* $khachhangs = Khachhangs::class;
        return view('khachhangs.index',compact('khachhangs')); */
    }

    public function store(StoreUserRequest $request){

        $this->authorize('employee_create');

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'email' => $request->email,
            'password' => Hash::make(env(PASSWORD_DEFAULT)),
        ]);
        $user->roles()->sync(2);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // dành cho phần lịch sử xóa
    public function deleteuser(){
        $users =XoaUser::class;
        return view('users.delete',compact('users'));
    }

    public function userrestore($id){
        User::whereId($id)->restore();
        return back();
    }

    public function userrestoreAll(){
        User::onlyTrashed()->restore();
        return back();
    }
    // kết thúc phần dành cho phần lịch sử xóa

    public function create(){
        $this->authorize('employee_create');

        return view('users.create');
    }

    public function edit(User $user){

        $this->authorize('employee_edit');

        return view('users.edit',compact('user'));
    }


    public function update(UpdateUserRequest $request, User $user){

        $this->authorize('employee_edit');

        $user->update($request->validated());
        return redirect()->route('users.index')->with('success','User updated successfully.');
    }

    public function destroy(User $user){

        $this->authorize('employee_delete');

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
