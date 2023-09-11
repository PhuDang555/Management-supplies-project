<x-splade-modal action="{{ route('chitiethoadonnhaps.store') }}">
    <h1 class="mb-2">Create new Receipt</h1>

    <x-splade-form>

        <x-splade-select name="hanghoa_id" label="Product">
            <option value="" selected>Select a Product</option>
            @foreach ($hanghoas as $hanghoa)
                <option value="{{ $hanghoa->id }}">
                    {{ $hanghoa->name }}
                </option>
            @endforeach
        </x-splade-select>
        <br>
        <x-splade-select name="nhacungcap_id" label="Provider">
            <option value="" selected>Select a Provider</option>
            @foreach ($nhacungcaps as $nhacungcap)
                <option value="{{ $nhacungcap->id }}">
                    {{ $nhacungcap->name }}
                </option>
            @endforeach
        </x-splade-select>
        <br>
        <x-splade-select name="user_id" label="Provider">
            <option value="" selected>Select a Provider</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">
                    {{ $user->name }}
                </option>
            @endforeach
        </x-splade-select>
        <br>
        <x-splade-input name="soluong" label="Quantity" class="mb-5" />
        <x-splade-input name="dongia" label="Price" class="mb-5" />
        <x-splade-input name="hansudung" type="date" label="Date" class="mb-5" />
        <x-splade-submit class="mt-5" />
    </x-splade-form>
</x-splade-modal>
