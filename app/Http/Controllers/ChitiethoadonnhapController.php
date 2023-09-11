<?php

namespace App\Http\Controllers;

use App\Tables\Chitiethoadonnhaps;
use Illuminate\Http\Request;
use App\Models\Chitiethoadonnhap;
use App\Models\Hoadonnhap;
use App\Models\Hanghoa;
use App\Models\Kho;
use App\Models\Lo;
use App\Models\User;
use App\Models\Nhacungcap;
use App\Http\Requests\StoreChitiethoadonnhapRequest;
use App\Http\Requests\UpdateChitiethoadonnhapRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChitiethoadonnhapController extends Controller
{
    public function index()
    {

        // $motcaigido = Hoadonnhap::query();
        // dd($motcaigido);
        return view('chitiethoadonnhaps.index', [
            'chitiethoadonnhaps' => Chitiethoadonnhaps::class,
        ]);
    }

    public function create()
    {
        //ncc
        // $hoadonnhaps = Hoadonnhap::with('chitiethoadonnhaps')->get();
        $nhacungcaps = Nhacungcap::get();

        //hang hoa
        $hanghoas = Hanghoa::get();

        $users = Auth::user()->get();

        return view('chitiethoadonnhaps.create', compact('hanghoas', 'nhacungcaps','users'));
    }


    public function store(StoreChitiethoadonnhapRequest $request)
    {
        // $users = Auth::user()->id;
        // dd($users);
        DB::beginTransaction();
        try {
            $users = User::findOrFail($request->user_id);

            $hanghoas = Hanghoa::findOrFail($request->hanghoa_id);

            $nhacungcaps = Nhacungcap::findOrFail($request->nhacungcap_id);

            $chitiethoadonnhap = Chitiethoadonnhap::create([
                'soluong' => $request->soluong,
                'dongia' => $request->dongia,
                'hansudung'=>$request->hansudung,
                'nhacungcap_id' => $request->nhacungcap_id,
                'hanghoa_id' => $request->hanghoa_id,
                'user_id' =>$request->user_id,
            ]);

            $kho = Kho::firstOrCreate(
                [ 'hanghoa_id' => $request->hanghoa_id],
                ['tongsoluong' => 0 ]
            );

            // dd($kho);
            $kho -> increment('tongsoluong',$request->soluong);
            /* $kho = Kho::updateOrCreate(
                [
                    'hanghoa_id' => $request->hanghoa_id
                ],
                [
                    'soluong' => $hanghoas -> increment('soluong',$request->soluong)
                ]
            ); */

            $lo = Lo::create(
                [ 'chitiethoadonnhap_id'=>$chitiethoadonnhap->id,
                'kho_id'=>$kho->id,
                'soluong'=>$request->soluong
                ]
            );

            // $lo = Lo::select('status')->first();

            // $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');

            // if($getStatus->status < $currentDateTime){
            //     $status = 1;
            // }else{
            //     $status = 0;
            // }

            // Lo::update(['status'=>$status]);


            DB::commit();
            return redirect()->route('chitiethoadonnhaps.index')->with('success', 'Student created successfully.');
            //code...
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('chitiethoadonnhaps.index')->with('success', $th->getMessage());
        }
    }

    public function edit(Chitiethoadonnhap $chitiethoadonnhap)
    {
        $this->authorize('chitiethoadonnhap_edit');
        $permissions = Permission::all();

        $nhacungcaps = Nhacungcap::with('chitiethoadonnhaps')->get();
        $hanghoas = Hanghoa::with('chitiethoadonnhaps')->get();
        $users = User::with('chitiethoadonnhaps')->get();

        return view('chitiethoadonnhaps.edit', compact('chitiethoadonnhap', 'nhacungcaps','hanghoas','users','permissions'));
    }

    public function update(UpdateChitiethoadonnhapRequest $request,Chitiethoadonnhap $chitiethoadonnhap)
    {

        $users = User::findOrFail($request->user_id);

        $hanghoas = Hanghoa::findOrFail($request->hanghoa_id);

        $nhacungcaps = Nhacungcap::findOrFail($request->nhacungcap_id);


        $chitiethoadonnhap->update($request->validated() + ['nhacungcap_id' => $nhacungcaps->nhacungcap_id]+ ['user_id' => $users->user_id] + ['hanghoa_id' =>$hanghoas->hanghoa_id]);

        return redirect()->route('chitiethoadonnhaps.index')->with('success', 'Student created successfully.');
    }

    public function destroy(Chitiethoadonnhap $chitiethoadonnhap)
    {
        $this->authorize('chitiethoadonnhap_delete');

        $chitiethoadonnhap->delete();

        return redirect()->route('chitiethoadonnhaps.index')->with('success', 'Student deleted successfully.');
    }
}
