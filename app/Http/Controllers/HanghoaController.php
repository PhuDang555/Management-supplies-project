<?php

namespace App\Http\Controllers;

use App\Tables\Hanghoas;
use App\Tables\XoaHanghoa;
use Illuminate\Http\Request;
use App\Models\Hanghoa;
use App\Models\Loaihang;
use App\Http\Requests\StoreHanghoaRequest;
use App\Http\Requests\UpdateHanghoaRequest;
use Illuminate\Support\Facades\Storage;


class HanghoaController extends Controller
{
    public function index()
    {
        return view('hanghoas.index', [
            'hanghoas' => Hanghoas::class,
        ]);
    }

    // dành cho phần lịch sử xóa
    public function deletehanghoa(){
        $hanghoas =XoaHanghoa::class;
        return view('hanghoas.delete',compact('hanghoas'));
    }

    public function hanghoarestore($id){
        Hanghoa::whereId($id)->restore();
        return back();
    }

    public function hanghoarestoreAll(){
        Hanghoa::onlyTrashed()->restore();
        return back();
    }
    // kết thúc phần dành cho phần lịch sử xóa

    public function create()
    {

        $loaihangs = Loaihang::with('hanghoas')->get();

        return view('hanghoas.create', compact('loaihangs'));
    }

    public function store(StoreHanghoaRequest $request)
    {

        $loaihangs = Loaihang::findOrFail($request->loaihang_id);

        $avatar = $request->file('avatar');
        $name = $avatar->hashName();

        Storage::put("public/avatars", $avatar);

        $hanghoa = Hanghoa::create([
            'avatar' => "storage/avatars/$name",
            'name' => $request->name,
            'donvitinh' => $request->donvitinh,
            'loaihang_id' => $request->loaihang_id,
        ]);

        return redirect()->route('hanghoas.index')->with('success', 'Product created successfully.');
    }

    public function edit(Hanghoa $hanghoa)
    {

        $loaihangs = Loaihang::with('hanghoas')->get();

        return view('hanghoas.edit', compact('hanghoa', 'loaihangs'));
    }

    public function update(UpdateStudentRequest $request, Hanghoa $hanghoa)
    {

        $loaihangs = Loaihang::findOrFail($request->loaihang_id);

        $student->update($request->validated() + ['loaihang_id' => $loaihangs->loaihang_id]);

        return redirect()->route('hanghoas.index')->with('success', 'Product created successfully.');
    }

    public function destroy(Hanghoa $hanghoa)
    {

        $hanghoa->delete();

        return redirect()->route('hanghoas.index')->with('success', 'Product deleted successfully.');
    }
}
