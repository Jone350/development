<x-layout.app>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-4 text-center">Welcome, {{ auth()->user()->first_name }}!</h2>
                <p class="text-center">This is your home page...</p>
                @foreach (session()->all() as $key => $value)
                    @if (is_array($value) || is_object($value))
                        <div class="alert alert-info">
                            <strong>{{ $key }}:</strong> {{ json_encode($value) }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            <strong>{{ $key }}:</strong> {{ $value }}
                        </div>
                    @endif
                    
                @endforeach
            </div>
        </div>
    </div>
</x-layout.app>