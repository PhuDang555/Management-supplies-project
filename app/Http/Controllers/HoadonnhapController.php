<?php

namespace App\Http\Controllers;

use App\Tables\Hoadonnhaps;
use Illuminate\Http\Request;
use App\Models\Hoadonnhap;
use App\Models\Nhacungcap;
use App\Models\User;
use App\Http\Requests\StoreHoadonnhapRequest;
use App\Http\Requests\UpdateHoadonnhapRequest;
use Illuminate\Support\Facades\Storage;

class HoadonnhapController extends Controller
{
    public function index()
    {
        return view('hoadonnhaps.index', [
            'hoadonnhaps' => Hoadonnhaps::class,
        ]);
    }

    public function create()
    {

        $users = User::with('hoadonnhaps')->get();
        $nhacungcaps = Nhacungcap::with('hoadonnhaps')->get();

        return view('hoadonnhaps.create', compact('users','nhacungcaps'));
    }

    public function store(StoreHoadonnhapRequest $request)
    {

        $users = User::findOrFail($request->user_id);
        $nhacungcaps = Nhacungcap::findOrFail($request->nhacungcap_id);

        $kho = Hoadonnhap::create([
            'user_id' => $request->user_id,
            'nhacungcap_id' => $request->nhacungcap_id
        ]);

        return redirect()->route('hoadonnhaps.index')->with('success', 'Student created successfully.');
    }

    public function edit(Hoadonnhap $hoadonnhap)
    {

        $users = User::with('hoadonnhaps')->get();
        $nhacungcaps = Nhacungcap::with('hoadonnhaps')->get();

        return view('hoadonnhaps.edit', compact('hoadonnhap', 'users','nhacungcaps'));
    }

    public function update(UpdateHoadonnhapRequest $request,Hoadonnhap $hoadonnhap)
    {

        $users = User::findOrFail($request->user_id);
        $nhacungcaps = Nhacungcap::findOrFail($request->nhacungcap_id);

        $hoadonnhap->update($request->validated() + ['user_id' => $users->user_id] + ['nhacungcap_id' =>$nhacungcaps->nhacungcap_id]);

        return redirect()->route('hoadonnhaps.index')->with('success', 'Student created successfully.');
    }

    public function destroy(Hoadonnhap $hoadonnhap)
    {

        $hoadonnhap->delete();

        return redirect()->route('hoadonnhaps.index')->with('success', 'Student deleted successfully.');
    }
}
