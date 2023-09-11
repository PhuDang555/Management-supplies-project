<x-splade-modal action="{{ route('chitiethoadonxuats.store') }}">
    <h1 class="mb-2 text-indigo-600">Create new Receipt</h1>

    <x-splade-form>

        <x-splade-select name="hanghoa_id" label="Product">
            <option value="" selected>Select a Product</option>
            @foreach ($hanghoas as $hanghoa)
                <option value="{{ $hanghoa['id'] }}">
                {{ $hanghoa['name'] }}
                </option>
            @endforeach
        </x-splade-select>
        <br>
        <x-splade-select name="khachhang_id" label="Customer">
            <option value="" selected>Select a Customer</option>
            @foreach ($khachhangs as $khachhang)
                <option value="{{ $khachhang->id }}">
                    {{ $khachhang->name }}
                </option>
            @endforeach
        </x-splade-select>
        <br>
        <x-splade-select name="user_id" label="User">
            <option value="" selected>Select a User</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">
                    {{ $user->name }}
                </option>
            @endforeach
        </x-splade-select>
        <br>
        <x-splade-input name="soluong" label="Quantity" class="mb-5" />
        <!-- <x-splade-input name="dongia" label="Price" class="mb-5" /> -->
        <x-splade-submit class="mt-5" />
    </x-splade-form>
</x-splade-modal>
