<x-splade-modal>
    <h1 class="mb-2 text-indigo-600">Update Warehouses ({{ $kho->name }})</h1>

    <x-splade-form action="{{ route('khos.update',$kho) }}" :default="$kho" method="PUT">
        <x-splade-input name="soluong" label="So luong" class="mb-5" />
        <x-splade-select name="hanghoa_id" label="Goods">
            <option value="" selected>Select a Product</option>
            @foreach ($hanghoas as $hanghoa)
                <option value="{{ $hanghoa->id }}">
                    {{ $hanghoa->name }}
                </option>
            @endforeach
        </x-splade-select>
        <x-splade-submit class="mt-5" />
    </x-splade-form>

</x-splade-modal>
