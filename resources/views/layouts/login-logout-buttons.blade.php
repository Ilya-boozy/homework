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