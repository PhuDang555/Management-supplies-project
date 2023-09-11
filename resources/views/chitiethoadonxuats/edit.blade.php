<x-splade-modal>
    <h1 class="mb-2 text-indigo-600">Update Receipt</h1>

    <x-splade-form action="{{ route('chitiethoadonxuats.update',$chitiethoadonxuat) }}" :default="$chitiethoadonxuat" method="PUT">
        <x-splade-input name="soluong" label="So luong" class="mb-5" />
        <x-splade-input name="dongia" label="Đơn giá" class="mb-5" />
        <x-splade-select name="kho_id" label="WareHouse">
            <option value="" selected>Select a WareHouse</option>
            @foreach ($khos as $kho)
                <option value="{{ $kho->id }}">
                Hóa đơn số  {{ $kho->id }}
                </option>
            @endforeach
        </x-splade-select>

        <x-splade-select name="hoadonxuat_id" label="Commodities">
            <option value="" selected>Select a Commodities</option>
            @foreach ($hoadonxuats as $hoadonxuat)
                <option value="{{ $hoadonxuat->id }}">
                    Hóa đơn số{{ $hoadonxuat->id }}
                </option>
            @endforeach
        </x-splade-select>
        <x-splade-submit class="mt-5" />
    </x-splade-form>
</x-splade-modal>
