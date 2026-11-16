
<header>
    
<h2 class="brand-logo">JSTN<span>.</span></h2>


    <nav>
        <a href="/"
           class="{{ request()->path() == '' ? 'active' : '' }}">
            Home
        </a>

        <a href="/data-diri"
           class="{{ request()->is('data-diri') ? 'active' : '' }}">
            Data Diri
        </a>

        <a href="/hobi"
           class="{{ request()->is('hobi') ? 'active' : '' }}">
            Hobi
        </a>
    </nav>
</header>
