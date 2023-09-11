<x-splade-modal action="{{ route('hoadonxuats.store') }}">
    <h1 class="mb-2 text-indigo-600">Create new Goods</h1>

    <x-splade-form>

        <x-splade-select name="user_id" label="Employee">
            <option value="" selected>Select a Employee</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">
                    {{ $user->name }}
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

        <x-splade-submit class="mt-5" />
    </x-splade-form>
</x-splade-modal>
