<x-admin-layout>
    <div class="flex justify-between">

        <h1 class="py-3 text-2xl font-semibold text-gray-700">Employees Index</h1>
        <div class="p-4">
            <Link href="{{ route('admin.employees.create') }}"
                class="px-4 py-2 text-white bg-indigo-500 rounded hover:bg-indigo-700">
            New employee
            </Link>
        </div>
    </div>
    <x-splade-table :for="$employees">
        @cell('action', $employee)
            <div class="space-x-2">
                <Link href="{{ route('admin.employees.edit', $employee) }}"
                    class="px-3 py-2 text-white bg-green-400 rounded hover:bg-green-600">Edit
                </Link>
                <Link href="{{ route('admin.employees.destroy', $employee) }}" method="DELETE" confirm="Delete the employee"
                    confirm-text="Are you sure?" confirm-button="Yes" cancel-button="No"
                    class="px-3 py-2 text-white bg-red-400 rounded hover:bg-red-600">Delete
                </Link>
            </div>
        @endcell
    </x-splade-table>
</x-admin-layout>
