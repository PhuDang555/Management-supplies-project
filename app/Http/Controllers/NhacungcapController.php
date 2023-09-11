<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tables\Nhacungcaps;
use App\Tables\XoaNhacungcap;
use App\Models\Nhacungcap;
use App\Http\Requests\StoreNhacungcapRequest;
use App\Http\Requests\UpdateNhacungcapRequest;
// use Illuminate\Support\Facades\Auth;

class NhacungcapController extends Controller
{
    public function index(){
        // $user  = Auth::user();
        // dd($user->name);
        return view('nhacungcaps.index',[
            'nhacungcaps' => Nhacungcaps::class,
        ]);
        /* $nhacungcaps = nhacungcaps::class;
        return view('nhacungcaps.index',compact('nhacungcaps')); */
    }
    public function store(StoreNhacungcapRequest $request){
        $nhacungcap = Nhacungcap::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'diachi' => $request->diachi

        ]);

        return redirect()->route('nhacungcaps.index')->with('success', 'Provider created successfully.');
    }

    // dành cho phần lịch sử xóa
    public function deletenhacungcap(){
        $nhacungcaps =XoaNhacungcap::class;
        return view('nhacungcaps.delete',compact('nhacungcaps'));
    }

    public function nhacungcaprestore($id){
        Nhacungcap::whereId($id)->restore();
        return back();
    }

    public function nhacungcaprestoreAll(){
        Nhacungcap::onlyTrashed()->restore();
        return back();
    }
    // kết thúc phần dành cho phần lịch sử xóa

    public function create(){
        return view('nhacungcaps.create');
    }

    public function edit(Nhacungcap $nhacungcap){
        return view('nhacungcaps.edit',compact('nhacungcap'));
    }


    public function update(UpdateNhacungcapRequest $request, Nhacungcap $nhacungcap){

        $nhacungcap->update($request->validated());
        return redirect()->route('nhacungcaps.index')->with('success','Provider updated successfully.');
    }

    public function destroy(Nhacungcap $nhacungcap){

        $nhacungcap->delete();

        return redirect()->route('nhacungcaps.index')->with('success', 'Provider deleted successfully.');
    }
}
