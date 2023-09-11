<x-splade-modal >
    <h1 class="mb-2 text-indigo-600">Update Commodities - {{$loaihang->name}}</h1>

    <x-splade-form action="{{ route('loaihangs.update',$loaihang) }}" :default="$loaihang" method="PUT">
        <x-splade-input name="name" label="Name" class="mb-5" />
        <x-splade-input name="mota" label="Description" type="text" class="mb-5" />
        <x-splade-submit class="mt-5" />
    </x-splade-form>
</x-splade-modal>
