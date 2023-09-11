<x-splade-modal action="{{ route('hanghoas.store') }}">
    <h1 class="mb-2 text-indigo-600">Create new Product</h1>

    <x-splade-form>
        <x-splade-input name="name" label="Name" class="mb-5" />
        <x-splade-select name="donvitinh" label="Unit">
            <option value="" selected>Select a Unit</option>
                <option value="Kilogram">
                    Kilograms
                </option>
                <option value="Child">
                    Child
                </option>
                <option value="Piece">
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
