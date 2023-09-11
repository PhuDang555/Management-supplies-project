<x-splade-modal action="{{ route('hoadonnhaps.store') }}">
    <h1 class="mb-2">Create new Goods</h1>

    <x-splade-form>

        <x-splade-select name="user_id" label="Commodities">
            <option value="" selected>Select a Commodities</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">
                    {{ $user->name }}
                </option>
            @endforeach
        </x-splade-select>

        <x-splade-select name="nhacungcap_id" label="Commodities">
            <option value="" selected>Select a Commodities</option>
            @foreach ($nhacungcaps as $nhacungcap)
                <option value="{{ $nhacungcap->id }}">
                    {{ $nhacungcap->name }}
                </option>
            @endforeach
        </x-splade-select>

        <x-splade-submit class="mt-5" />
    </x-splade-form>
</x-splade-modal>
