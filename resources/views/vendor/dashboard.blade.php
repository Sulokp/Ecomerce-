<x-app-layout>
    <div class="container">
        <h1>Vendor Dashboard</h1>

        <p>Welcome, {{ auth()->user()->name }}</p>

        <ul>
            <li>
                <a href="#">My Products</a>
            </li>
            <li>
                <a href="#">Add Product</a>
            </li>
            <li>
                <a href="#">Orders</a>
            </li>
        </ul>
    </div>
</x-app-layout>
