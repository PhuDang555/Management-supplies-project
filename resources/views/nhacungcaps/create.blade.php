<x-splade-modal action="{{ route('nhacungcaps.store') }}">
    <h1 class="mb-2 text-indigo-600">Create new Provider</h1>

    <x-splade-form>
        <x-splade-input name="name" label="Name" class="mb-5" />
        <x-splade-input name="phone" label="Phone Number" type="text" class="mb-5" />
        <x-splade-input name="diachi" label="Address" type="text" class="mb-5" />

        <x-splade-submit class="mt-5" />
    </x-splade-form>
</x-splade-modal>
