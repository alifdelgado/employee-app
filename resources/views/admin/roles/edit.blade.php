<x-admin-layout>
    <h1 class="py-3 text-2xl font-semibold text-gray-700">Edit Role</h1>
    <x-splade-form class="p-4 space-y-3 bg-white border rounded shadow" :default="$role" :action="route('admin.roles.update', $role)"
        method="PATCH">
        <x-splade-input name="name" :label="__('Name')" />
        <x-splade-select name="permissions[]" :label="__('Select permissions')" :options="$permissions" multiple relation choices />
        <x-splade-submit />
    </x-splade-form>
</x-admin-layout>
