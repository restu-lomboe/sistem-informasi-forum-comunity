<style>
    .btn-submit{
        position: relative;
        right: 40px;
    }
</style>
<nav class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href=" {{ route('home') }} ">LarahubSanbercode</a>
        <div class="form-inline">
            <form class="">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                <button class="border-0 btn-submit" type="submit" style="background: none;"><i class="fas fa-search"></i></button>
            </form>
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-success my-2 my-sm-0 mr-sm-2" type="submit">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-success my-2 my-sm-0" type="submit">Register</a>
            @else
                <a href=" {{ route('account', Auth::user()->id) }} " class="my-2 my-sm-0 mr-sm-2">Hi, {{ Auth::user()->nama }} </a>|&nbsp;&nbsp;
                <a href="{{ route('logout') }}" class="my-2 my-sm-0" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </div>
    </div>
</nav>
