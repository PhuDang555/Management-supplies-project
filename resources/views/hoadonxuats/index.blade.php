<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Goods List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Link slideover href="{{ route('hoadonxuats.create') }}"
                    class="mb-5 inline-flex rounded-md shadow-sm bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline">
                Create Receipt
                </Link>
            <x-splade-table :for="$hoadonxuats">
                <x-slot:empty-state>
                <h1 style="
                        font-size: 18px;
                        text-align: center;
                        color: blue;
                        font-weight: bold;
                    ">The data is currently blank!</h1>
                    </x-slot>
                    <x-splade-cell actions as="$hoadonxuat">

                            <Link slideover href="{{ route('hoadonxuats.edit', $hoadonxuat->id) }}" class="text-indigo-600 mr-2"> Edit
                            </Link>

                            <x-splade-form action="{{ route('hoadonxuats.destroy', $hoadonxuat) }}" method="DELETE" confirm>
                                <button class="text-bold text-indigo-600" type="submit">Delete</button>
                            </x-splade-form>

                    </x-splade-cell>

            </x-splade-table>
        </div>
    </div>
</x-app-layout>
