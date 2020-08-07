<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand pltsword" href="{{ url('/') }}">
            <img src="{{ asset('img/pleets125.png') }}" alt="" width="40">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('contact.create') }}">{{ __('contact.navigation.text') }}</a>
                </li>

                @php
                    $pages = \App\Page::all();
                @endphp

                @if ($pages)
                    @foreach($pages as $page)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pages', ['title' => $page->url_path ]) }}">{{ $page->title }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- FB Social Plugin -->
                @if(config('facebook.home.activated'))
                    <div class="fb-like"
                         data-href="{{ config('facebook.fb_page_url', route('home')) }}"
                         data-width=""
                         data-layout="{{ config('facebook.home.layout') }}"
                         data-action="{{ config('facebook.home.action') }}"
                         data-size="{{ config('facebook.home.size') }}"
                         data-share="{{ config('facebook.home.share_button') }}"
                         style="line-height: 2.4">
                    </div>
                @endif

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.posts') }}">
                                Posts
                            </a>

                            <a class="dropdown-item" href="{{ route('admin.pages') }}">
                                Pages
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
