<x-layout.app>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-4 text-center">Welcome, {{ auth()->user()->first_name }}!</h2>
                <p class="text-center">This is your home page.</p>

            </div>
        </div>
    </div>
</x-layout.app>