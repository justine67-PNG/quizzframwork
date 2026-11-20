<header class="main-header">

    <div class="header-container">

        <!-- LOGO -->
        <a href="/" class="brand-logo">
            JSTN<span>.</span>
        </a>

        <!-- NAVIGATION -->
        <nav class="nav-menu">

            <a href="/"
               class="{{ request()->path() == '' ? 'active' : '' }}">
                HOME
            </a>

            <a href="/data-diri"
               class="{{ request()->is('data-diri') ? 'active' : '' }}">
                ABOUT ME
            </a>

            <a href="/hobi"
               class="{{ request()->is('hobi') ? 'active' : '' }}">
                HOBBIES
            </a>

        </nav>

        <!-- SEARCH -->
        <form class="search-box" action="#" method="GET">

            <input type="text" name="search" placeholder="SEARCH">

            <button type="submit">⌕</button>

        </form>

        <a href="{{ url('/login') }}" class="login-btn">
    <i class="fas fa-sign-in-alt"></i>
    Login
</a>


    </div>

</header>
