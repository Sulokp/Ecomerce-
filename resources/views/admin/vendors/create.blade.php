<x-app-layout>
    <div class="container">
        <h1>Create Vendor</h1>

        <form method="POST" action="{{ route('admin.vendors.store') }}">
            @csrf

            <div>
                <label>Name</label>
                <input type="text" name="name" required>
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div>
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit">Create Vendor</button>
        </form>
    </div>
</x-app-layout>
