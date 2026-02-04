<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Vendors</h1>

        <!-- Create Vendor Link -->
        <a href="{{ route('admin.vendors.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
            Create Vendor
        </a>

        <hr class="my-4">

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($vendors->count())
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="text-left p-2">Name</th>
                        <th class="text-left p-2">Email</th>
                        <th class="text-left p-2">Status</th>
                        <th class="text-left p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendors as $vendor)
                        <tr class="border-b">
                            <td class="p-2">{{ $vendor->name }}</td>
                            <td class="p-2">{{ $vendor->email }}</td>
                            <td class="p-2">
                                {{ $vendor->is_active ? 'Approved' : 'Pending' }}
                            </td>
                            <td class="p-2">
                                @if(!$vendor->is_active)
                                    <form method="POST" action="{{ route('admin.vendors.approve', $vendor->id) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">
                                            Approve
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('admin.vendors.disable', $vendor->id) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">
                                            Disable
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No vendors found.</p>
        @endif
    </div>
</x-app-layout>
