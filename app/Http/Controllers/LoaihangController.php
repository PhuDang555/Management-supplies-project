<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tables\Loaihangs;
use App\Tables\XoaLoaihang;
use App\Models\Loaihang;
use App\Http\Requests\StoreLoaihangRequest;
use App\Http\Requests\UpdateLoaihangRequest;
use Illuminate\Support\Facades\Auth;

class LoaihangController extends Controller
{
    public function index(){
        // $user  = Auth::user();
        // dd($user->name);
        return view('loaihangs.index',[
            'loaihangs' => Loaihangs::class,
        ]);
        /* $nhacungcaps = nhacungcaps::class;
        return view('nhacungcaps.index',compact('nhacungcaps')); */
    }
    public function store(StoreLoaihangRequest $request){
        $loaihang = Loaihang::create([
            'name' => $request->name,
            'mota' => $request->mota
        ]);

        return redirect()->route('loaihangs.index')->with('success', 'Commodities created successfully.');
    }

    // dành cho phần lịch sử xóa
    public function deleteloaihang(){
        $loaihangs =XoaLoaihang::class;
        return view('loaihangs.delete',compact('loaihangs'));
    }

    public function loaihangrestore($id){
        Loaihang::whereId($id)->restore();
        return back();
    }

    public function loaihangrestoreAll(){
        Loaihang::onlyTrashed()->restore();
        return back();
    }
    // kết thúc phần dành cho phần lịch sử xóa

    public function create(){
        return view('loaihangs.create');
    }

    public function edit(Loaihang $loaihang){
        return view('loaihangs.edit',compact('loaihang'));
    }


    public function update(UpdateLoaihangRequest $request, Loaihang $loaihang){

        $loaihang->update($request->validated());
        return redirect()->route('loaihangs.index')->with('success','Commodities updated successfully.');
    }

    public function destroy(Loaihang $loaihang){

        $loaihang->delete();

        return redirect()->route('loaihangs.index')->with('success', 'Commodities deleted successfully.');
    }
}
