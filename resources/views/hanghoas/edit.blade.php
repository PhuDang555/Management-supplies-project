<x-splade-modal>
    <h1 class="mb-2 text-indigo-600">Update Product ({{ $hanghoa->name }})</h1>

    <x-splade-form action="{{ route('hanghoas.update',$hanghoa) }}" :default="$hanghoa" method="PUT">
        <x-splade-input name="name" label="Name" class="mb-5" />
        <x-splade-select name="donvitinh" label="Unit">
            <option value="" selected>Select a Unit</option>
                <option value="Kg">
                    Kilogram
                </option>
                <option value="Con">
                    Child
                </option>
                <option value="Cai">
                    Piece
                </option>
        </x-splade-select> <br>
        <x-splade-select name="loaihang_id" label="Commodities">
            <option value="" selected>Select a Commodities</option>
            @foreach ($loaihangs as $loaihang)
                <option value="{{ $loaihang->id }}">
                    {{ $loaihang->name }}
                </option>
            @endforeach
        </x-splade-select>

        <x-splade-file class="mt-5" name="avatar" label="Avartar" filepond  max-size="2MB" preview
            accept="image/png" />

        <x-splade-submit class="mt-5" />
    </x-splade-form>
</x-splade-modal>
