<x-splade-modal >
    <h1 class="mb-2  text-indigo-600">Update Customer - {{$khachhang->name}}</h1>

    <x-splade-form action="{{ route('khachhangs.update',$khachhang) }}" :default="$khachhang" method="PUT">
        <x-splade-input name="name" label="Name" class="mb-5" />
        <x-splade-input name="phone" label="Phone Number" type="text" class="mb-5" />
        <x-splade-input name="diachi" label="Address" type="text" class="mb-5" />

        <x-splade-submit class="mt-5" />
    </x-splade-form>
</x-splade-modal>
