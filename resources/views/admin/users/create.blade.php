<x-admin-layout>
    <h1 class="py-3 text-2xl font-semibold text-gray-700">New User</h1>
    <x-splade-form class="p-4 space-y-3 bg-white border rounded shadow" :action="route('admin.users.store')" method="POST">
        <x-splade-input name="username" :label="__('Username')" />
        <x-splade-input name="first_name" label="First name" />
        <x-splade-input name="last_name" label="Last name" />
        <x-splade-input name="email" label="Email address" />
        <x-splade-input type="password" name="password" label="Password" />
        <x-splade-input type="password" name="password_confirmation" label="Confirm password " />
        <x-splade-select name="roles[]" :label="__('Select roles')" :options="$roles" multiple relation choices />
        <x-splade-select name="permissions[]" :label="__('Select permissions')" :options="$permissions" multiple relation choices />
        <x-splade-submit />
    </x-splade-form>
</x-admin-layout>
