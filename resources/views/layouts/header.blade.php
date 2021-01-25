<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Home</a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    @if (Route::has('login'))
                        @auth
                            @inject('weather','\App\Services\WeatherService')
                            <a href="{{ route('orders.index',["group"=>"all"]) }}" class="nav-link">Orders list</a>
                        @endauth
                    @endif
                </div>
            </div>
            @auth
                <nav class="navbar navbar-light bg-light">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1">
                        {{$weather->get_weather()}}
                    </span>
                </div>
            </nav>
            @endauth
            @include('layouts.login-logout-buttons')
        </div>
    </nav>
</header>


