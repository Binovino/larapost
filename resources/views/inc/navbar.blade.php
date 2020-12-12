<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            LARAPOST
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        @if(Auth::guest())
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link mx-1" href="/">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-1" href="/posts">BLOGS</a>
                </li>
                <li class="nav-item">
                <a class="nav-link ml-1" href="/about">ABOUT</a>
                </li> 
            </ul>
        
            @else

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link mx-1" href="/">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-1" href="/posts">BLOGS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-1" href="/about">ABOUT</a>
                </li> 
            </ul>
    

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">

                <!-- Authentication Links -->
                @if(!Auth::guest())
                    <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @can('manage-users')
                                    <a class="dropdown-item" href="{{ route('admin.users.index') }}">User Management</a> 
                                @endcan  
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form> 
                            </div>
                    </li>
                @endif
            </ul> 
        @endif
        </div>
    </div>
</nav>

