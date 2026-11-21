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

        <!-- GLOBE + SEARCH + SIGN IN -->
        <div class="header-actions">

            <button type="button" class="globe-btn" aria-label="Bahasa">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none"
                     stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M3 12h18M12 3c2.5 2.6 3.8 5.6 3.8 9s-1.3 6.4-3.8 9c-2.5-2.6-3.8-5.6-3.8-9S9.5 5.6 12 3z"/>
                </svg>
            </button>

            <form class="search-box" action="#" method="GET">
                <input type="text" name="search" placeholder="SEARCH">
                <button type="submit" aria-label="Cari">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="none"
                         stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                        <circle cx="10.5" cy="10.5" r="6.5"/>
                        <path d="M15.5 15.5L21 21"/>
                    </svg>
                </button>
            </form>

            <a href="{{ url('/login') }}" class="login-btn">SIGN IN</a>

        </div>

    </div>

</header>