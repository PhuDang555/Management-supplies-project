<?php

namespace App\Http\Controllers;

use App\Tables\Hoadonxuats;
use Illuminate\Http\Request;
use App\Models\Hoadonxuat;
use App\Models\Khachhang;
use App\Models\User;
use App\Http\Requests\StoreHoadonxuatRequest;
use App\Http\Requests\UpdateHoadonxuatRequest;
use Illuminate\Support\Facades\Storage;

class HoadonxuatController extends Controller
{
    public function index()
    {
        return view('hoadonxuats.index', [
            'hoadonxuats' => Hoadonxuats::class,
        ]);
    }

    public function create()
    {

        $users = User::with('hoadonxuats')->get();
        $khachhangs = Khachhang::with('hoadonxuats')->get();

        return view('hoadonxuats.create', compact('users','khachhangs'));
    }

    public function store(StoreHoadonxuatRequest $request)
    {

        $users = User::findOrFail($request->user_id);
        $khachhangs = Khachhang::findOrFail($request->khachhang_id);

        $kho = Hoadonxuat::create([
            'user_id' => $request->user_id,
            'khachhang_id' => $request->khachhang_id
        ]);

        return redirect()->route('hoadonxuats.index')->with('success', 'Student created successfully.');
    }

    public function edit(Hoadonxuat $hoadonxuat)
    {

        $users = User::with('hoadonxuats')->get();
        $khachhangs = Khachhang::with('hoadonxuats')->get();

        return view('hoadonxuats.edit', compact('hoadonxuat', 'users','khachhangs'));
    }

    public function update(UpdateHoadonxuatRequest $request,Hoadonxuat $hoadonxuat)
    {

        $users = User::findOrFail($request->user_id);
        $khachhangs = Khachhang::findOrFail($request->khachhang_id);

        $hoadonxuat->update($request->validated() + ['user_id' => $users->user_id] + ['khachhang_id' =>$khachhangs->khachhang_id]);

        return redirect()->route('hoadonxuats.index')->with('success', 'Student created successfully.');
    }

    public function destroy(Hoadonxuat $hoadonxuat)
    {

        $hoadonxuat->delete();

        return redirect()->route('hoadonxuats.index')->with('success', 'Student deleted successfully.');
    }
}
