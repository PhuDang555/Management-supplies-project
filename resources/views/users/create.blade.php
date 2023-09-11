<x-splade-modal action="{{ route('users.store') }}">
    <h1 class="mb-2 text-indigo-600">Create new User</h1>

    <x-splade-form>



            <x-splade-input id="name" type="text" name="name" :label="__('Name')" required autofocus /><br>
            <x-splade-input id="email" type="email" name="email" :label="__('Email')" required /><br>
            <x-splade-input id="phone" type="text" name="phone" :label="__('Phone')" required /><br>
            <x-splade-input id="birth_date" type="date" name="birth_date" :label="__('Birthday')" required /><br>
            <x-splade-input id="password" type="password" name="password" :label="__('Password')" required autocomplete="new-password" /><br>
            <x-splade-input id="password_confirmation" type="password" name="password_confirmation" :label="__('Confirm Password')" required /><br>
            <x-splade-submit class="mt-5" />
        </x-splade-form>
</x-splade-modal>
