<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Home</a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/orders-list') }}" class="nav-link">Orders list</a>
                        @endauth
                        <div class="btn-group" role="group" aria-label="Basic example">
                            @auth
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">
                                        {{ __('Logout') }}
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</header>


