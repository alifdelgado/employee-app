<x-admin-layout>
    <h1 class="py-3 text-2xl font-semibold text-gray-700">New Permission</h1>
    <x-splade-form class="p-4 space-y-3 bg-white border rounded shadow" :action="route('admin.permissions.store')" method="POST">
        <x-splade-input name="name" :label="__('Name')" />
        <x-splade-select name="roles[]" :label="__('Select roles')" :options="$roles" multiple relation choices />
        <x-splade-submit />
    </x-splade-form>
</x-admin-layout>
