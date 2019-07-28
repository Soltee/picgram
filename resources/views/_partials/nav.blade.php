<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            Home
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.create') }}">
            Upload
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('browse') }}">
            Browse
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('profile', Auth::user()->id) }}">
            Profile
        </a>
    </li>
</ul>