    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/home">MyApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about-us">About Us</a>
                    </li>
                </ul>
            </div>
            <div class="align-items-end">
                @if (Auth::check())
                    <button type="button" id="logout-btn" class="btn btn-danger">Logout</button>
                @endif
            </div>
        </div>
    </nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoutBtn = document.getElementById('logout-btn');

        if (logoutBtn) {
            logoutBtn.addEventListener('click', function (e) {
                e.preventDefault(); // Prevent default anchor/button behavior

                if (confirm('Are you sure you want to logout?')) {
                    $.ajax({
                        url: '{{ route('logout') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function () {
                            window.location.href = '{{ route('login') }}';
                        },
                        error: function (xhr, status, error) {
                            console.error('Logout error:', error);
                            alert('Logout failed. Please try again.');
                        }
                    });
                }
            });
        }
    });
</script>
