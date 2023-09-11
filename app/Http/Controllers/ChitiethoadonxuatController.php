<?php

namespace App\Http\Controllers;

use App\Tables\Chitiethoadonxuats;
use Illuminate\Http\Request;
use App\Models\Chitiethoadonxuat;
use App\Models\Hoadonxuat;
use App\Models\Kho;
use App\Models\Lo;
use App\Models\Hanghoa;
use App\Models\User;
use App\Models\Khachhang;
use App\Http\Requests\StoreChitiethoadonxuatRequest;
use App\Http\Requests\UpdateChitiethoadonxuatRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ChitiethoadonxuatController extends Controller
{
    public function index()
    {

        $khos = Kho::with('los')->get();

        $los = Lo::with('kho')->get();

        $warehouseData = $khos->map(function ($kho) {

            $kho->los->map(function ($item){
                // $chitiets = $item->chitiethoadonnhap;
                $soluong = $item->soluong;
                // foreach($chitiets as $chitiet){
                //     if(Carbon::parse($chitiet->hansudung) < Carbon::now()){
                //     //    return
                //     }
                // }

            });


            return [
                'hanghoa_id' => $kho->hanghoa->name,
                'soluong' => $kho->soluong,
            ];
        });

        // dd($warehouseData);

        return view('chitiethoadonxuats.index', [
            'chitiethoadonxuats' => Chitiethoadonxuats::class,
        ]);
    }

    public function create()
    {

        $users = Auth::user()->get();
        $khachhangs = Khachhang::get();

        $khos = Kho::with('chitiethoadonxuats')->where('tongsoluong' ,'>',0)->get();
        // dd($khos);
        $hanghoas = Kho::with('hanghoa')->get();
        $hanghoas=$hanghoas->map(function($item){
            return ["name" => $item->hanghoa->name,
                "id" => $item->hanghoa->id];
        });
        // dd($dd);
        return view('chitiethoadonxuats.create', compact('users','hanghoas','khachhangs'));
    }

    public function store(StoreChitiethoadonxuatRequest $request)
    {
        DB::beginTransaction();
        try {
            $users = User::findOrFail($request->user_id);
            $khachhangs = Khachhang::findOrFail($request->khachhang_id);

            // $khos = Kho::findOrFail($request->kho_id);
            $hanghoa = Hanghoa::findOrFail($request->hanghoa_id);
            $khos = $hanghoa->khos;

            // Xử lý hàng tồn lô
            $los = $khos->los()->where('status', '=', 0)->get();
            $tongconhan = $los->sum('soluong');
            // dd($tongconhan);

            // $loshet = $khos->los()->where('status', '=', 1)->get();

            // $tonghethan = $loshet->sum('soluong');
            // dd($tonghethan);

            if($tongconhan < $request->soluong){
                return redirect()->route('chitiethoadonxuats.index')->with('warning', 'Insufficient quantity in stock.');
            }

            $soluongBD = $request->soluong;//60
            $soluongST = $request->soluong;//60
            foreach($los as $lo ){
                $soluongST = $soluongBD - $lo->soluong;//20
                if($soluongST>0){ //=> lo ko du sl cap
                    $lo->decrement('soluong', $lo->soluong); //lo=0
                    $soluongBD = $soluongST;
                }else{
                    $lo->decrement('soluong', $soluongBD);//10
                    break;
                }
            }
            // giảm số lượng kho
            $khos -> decrement('tongsoluong',$request->soluong);
            //Thêm hóa đơn
            $chitiethoadonxuat = Chitiethoadonxuat::create([
                'soluong' => $request->soluong,
                // 'dongia' => $request->dongia,
                'khachhang_id' => $request->khachhang_id,
                'kho_id' => $khos->id,
                'user_id' =>$request->user_id,
            ]);

            DB::commit();
            return redirect()->route('chitiethoadonxuats.index')->with('success', 'Export reciept created successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            // dd($th->getMessage());
            return redirect()->route('chitiethoadonxuats.index')->with('success', $th->getMessage());
        }




    }

    public function edit(Chitiethoadonxuat $chitiethoadonxuat)
    {
        $this->authorize('chitiethoadonnhap_edit');
        $hoadonxuats = Hoadonxuat::with('chitiethoadonxuats')->get();
        $khos = Kho::with('chitiethoadonxuats')->get();

        return view('chitiethoadonxuats.edit', compact('chitiethoadonxuat', 'hoadonxuats','khos'));
    }

    public function update(UpdateHoadonxuatRequest $request,Chitiethoadonxuat $chitiethoadonxuat)
    {

        $hoadonxuats = Hoadonxuat::findOrFail($request->hoadonxuat_id);
        $khos = Khos::findOrFail($request->kho_id);

        $chitiethoadonxuat->update($request->validated() + ['hoadonxuat_id' => $hoadonxuats->hoadonxuat_id] + ['kho_id' =>$khos->kho_id]);

        return redirect()->route('chitiethoadonxuats.index')->with('success', 'Export reciept created successfully.');
    }

    public function destroy(Chitiethoadonxuat $chitiethoadonxuat)
    {
        $this->authorize('chitiethoadonnhap_delete');
        $chitiethoadonxuat->delete();

        return redirect()->route('chitiethoadonxuats.index')->with('success', 'Export reciept deleted successfully.');
    }
}
