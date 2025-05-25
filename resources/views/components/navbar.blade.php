<nav class="navbar">
    <a href="/" class="text-xl font-bold">{{ env('APP_NAME') }}</a>
    <div>
        @auth
            <span class="mr-4">{{ Auth::user()->email }}</span>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button class="text-red-600 hover:underline">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="mr-4"> 
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
            <a href="{{ route('register') }}"> 
                <i class="fas fa-user-plus"></i> Register
            </a>
        @endauth
    </div>
</nav>
