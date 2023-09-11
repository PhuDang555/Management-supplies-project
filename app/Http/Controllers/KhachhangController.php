<?php

namespace App\Http\Controllers;

use App\Tables\Khachhangs;
use App\Tables\XoaKhachhang;
use Illuminate\Http\Request;
use App\Models\Khachhang;
use App\Http\Requests\StoreKhachhangRequest;
use App\Http\Requests\UpdateKhachhangRequest;
use ProtoneMedia\Splade\SpladeTable;

class KhachhangController extends Controller
{
    public function index(){

        // toastr()->success('Đây là thông báo thành công.', 'Thành công');

        return view('khachhangs.index',[
            'khachhangs' => Khachhangs::class,
        ]);

        // $khachhangs =Khachhangs::class;
        // return view('khachhangs.index',compact('khachhangs'));

    }

    public function store(StoreKhachhangRequest $request){
        $khachhang = Khachhang::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'diachi' => $request->diachi

        ]);

        return redirect()->route('khachhangs.index')->with('success', 'Customer created successfully !!!');
    }

    public function create(){
        return view('khachhangs.create');
    }
    // dành cho phần lịch sử xóa
    public function deletekhachhang(){
        $khachhangs =XoaKhachhang::class;
        return view('khachhangs.delete',compact('khachhangs'));
    }

    public function khachhangrestore($id){
        Khachhang::whereId($id)->restore();
        return back()->with('success','Employee restored successfully !!!');
    }

    public function khachhangrestoreAll(){
        Khachhang::onlyTrashed()->restore();
        return back();
    }
    // kết thúc phần dành cho phần lịch sử xóa


    public function edit(Khachhang $khachhang){
        // dd($khachhang);
        return view('khachhangs.edit',compact('khachhang'));
    }


    public function update(UpdateKhachhangRequest $request, Khachhang $khachhang){

        $khachhang->update($request->validated());
        return redirect()->route('khachhangs.index')->with('success','Employee updated successfully !!!');
    }

    public function destroy(Khachhang $khachhang){

        $khachhang->delete();

        return redirect()->route('khachhangs.index')->with('success', 'Employee deleted successfully !!!');
    }
}


