<x-admin-layout>
    <h1 class="py-3 text-2xl font-semibold text-gray-700">New Country</h1>
    <x-splade-form class="p-4 space-y-3 bg-white border rounded shadow" :action="route('admin.countries.store')" method="POST">
        <x-splade-input name="name" :label="__('Country')" />
        <x-splade-input name="code" label="Country code" />
        <x-splade-submit />
    </x-splade-form>
</x-admin-layout>
