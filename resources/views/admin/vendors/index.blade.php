<x-app-layout>
    <div class="container">
        <h1>Vendors</h1>

        <a href="{{ route('admin.vendors.create') }}">
            Create Vendor
        </a>

        <hr>

        @if($vendors->count())
            <ul>
                @foreach($vendors as $vendor)
                    <li>
                        {{ $vendor->name }} – {{ $vendor->email }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>No vendors found.</p>
        @endif
    </div>
</x-app-layout>
