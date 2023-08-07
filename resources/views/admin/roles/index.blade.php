<x-admin-layout>
    <div class="flex justify-between">

        <h1 class="py-3 text-2xl font-semibold text-gray-700">Roles Index</h1>
        <div class="p-4">
            <Link href="{{ route('admin.roles.create') }}"
                class="px-4 py-2 text-white bg-indigo-500 rounded hover:bg-indigo-700">
            New role
            </Link>
        </div>
    </div>
    <x-splade-table :for="$roles">
        @cell('action', $role)
            <div class="space-x-2">
                <Link href="{{ route('admin.roles.edit', $role) }}"
                    class="px-3 py-2 text-white bg-green-400 rounded hover:bg-green-600">Edit
                </Link>
                <Link href="{{ route('admin.roles.destroy', $role) }}" method="DELETE" confirm="Delete the role"
                    confirm-text="Are you sure?" confirm-button="Yes" cancel-button="No"
                    class="px-3 py-2 text-white bg-red-400 rounded hover:bg-red-600">Delete
                </Link>
            </div>
        @endcell
    </x-splade-table>
</x-admin-layout>
