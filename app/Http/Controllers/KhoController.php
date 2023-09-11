<?php

namespace App\Http\Controllers;

use App\Tables\Khos;
use App\Tables\Los;
use Illuminate\Http\Request;
use App\Models\Kho;
use App\Models\Lo;
use App\Models\Hanghoa;
use App\Http\Requests\StoreKhoRequest;
use App\Http\Requests\UpdateKhoRequest;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KhoController extends Controller
{
    public function index()
    {
        // Tính số lượng hàng hóa đã hết hạn có trạng thái bằng 1
        $khos = Khos::class;

        // $totals = Kho::with('los')->get();
        // $totals = $totals->map(function ($item){
        //     $tonghethan;
        //     $tongconhan;
        //     $item->los->map(function ($itemlo) use (&$tonghethan,&$tongconhan) {
        //         $soluong = $itemlo->soluong;
        //         $status = $itemlo->status;

        //         if($status == 1 ){
        //             return  $tonghethan += $soluong;
        //         }else{
        //             return  $tongconhan += $soluong;
        //         }
        //     });

        //     return [
        //         "tonghethan" => $tonghethan,
        //         "tongconhan" => $tongconhan,
        //     ];
        // });
        // dd($totals);

        return view('khos.index',compact('khos'));
    }

    public function detail()
    {
        $details =Los::class;
        return view('khos.list',compact('details'));
    }

    public function create()
    {

        $hanghoas = Hanghoa::with('khos')->get();

        return view('khos.create', compact('hanghoas'));
    }

    public function store(StoreKhoRequest $request)
    {

        $hanghoas = Hanghoa::findOrFail($request->hanghoa_id);

        $kho = Kho::create([
            'hanghoa_id' => $request->hanghoa_id,
            'soluong' => $request->soluong
        ]);

        return redirect()->route('khos.index')->with('success', 'Student created successfully.');
    }

    public function edit(Kho $kho)
    {

        $hanghoas = Hanghoa::with('khos')->get();

        return view('khos.edit', compact('kho', 'hanghoas'));
    }

    public function update(UpdateKhoRequest $request, Kho $kho)
    {

        $hanghoas = Hanghoa::findOrFail($request->hanghoa_id);

        $kho->update($request->validated() + ['hanghoa_id' => $hanghoas->hanghoa_id]);

        return redirect()->route('khos.index')->with('success', 'Student created successfully.');
    }

    public function destroy(Kho $kho)
    {

        $kho->delete();

        return redirect()->route('khos.index')->with('success', 'Student deleted successfully.');
    }
}
