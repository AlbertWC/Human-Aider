<nav class="navbar navbar-static-top navbar-inverse">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/posts') }}">
                {{ config('app.name', 'Human Aider') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            @if (Auth::guard('web')->check())
            <ul class="nav navbar-nav">
                <li><a href="/posts/create">Create Post</a></li>
                <li><a href="/sawvictim?page=1">Saw Victim</a></li>
                <li><a href="/analytics"> Analytics</a></li>
            </ul>
            @endif
            @if (Auth::guard('admin')->check())
            <ul class="nav navbar-nav">
                <li><a href="/admin/report">View Report</a></li>
                <li><a href="/posts">View Post</a></li>
            </ul>
            @endif


            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a class="btn btn-default"href="{{ route('login') }}">Login</a></li>
                    <li><a class="btn btn-default"href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                @if (Auth::guard('web')->check())
                                    <a href="/home">Home</a>
                                @endif
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>