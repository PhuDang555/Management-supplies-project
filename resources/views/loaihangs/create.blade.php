<x-splade-modal action="{{ route('loaihangs.store') }}">
    <h1 class="mb-2 text-indigo-600">Create Commodities</h1>

    <x-splade-form>
        <x-splade-input name="name" label="Name" class="mb-5" />
        <x-splade-input name="mota" label="Description" type="text" class="mb-5" />
        <x-splade-submit class="mt-5" />
    </x-splade-form>
</x-splade-modal>
