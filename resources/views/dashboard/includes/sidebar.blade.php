<div class="sidebar">

    <nav class="sidebar-nav">
        
        <ul class="nav">
            <li class="nav navbar-nav {{ app()->getlocale() == 'ar' ? 'pull-left' : 'pull-right' }}  hidden-md-down">
                <li class="nav-item dropdown" style="
                text-align: center;
            ">
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        @if(!auth()->user()->avatar)
                        <img src="{{ asset('dashboard/img/avatars/default.png') }}"  style="
                        width: 100px;
    height: 100px;
    border: 2px solid #eee;
    border-radius: 5px;
                    " alt="{{ auth()->user()->email }}">
                        @else 
                        <img src="{{ asset(auth()->user()->avatar) }}"  alt="{{ auth()->user()->email }}" style="
                        width: 100px;
    height: 100px;
    border: 2px solid #eee;
    border-radius: 5px;
                    ">
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header text-xs-center">
                            <strong>{{ __('words.settings') }}</strong>
                        </div>
                        <a class="dropdown-item" href="{{ route('users.edit',auth()->user()) }}"><i class="fa fa-user"></i> 
                        {{ __('words.profile') }}</a>
                        <a class="dropdown-item" href="{{ route('users.edit.pass',auth()->user()) }}"><i class="fa fa-user"></i> 
                        {{ __('words.user privacy') }}</a>
                        <div class="divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
        
                            <x-dropdown-link :href="route('logout')" class="dropdown-item"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class="fa fa-lock"></i>
                                {{ __('words.log out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    
                </li>
                
            </li>
                    <li class="nav-item p-x-1 nav-item dropdown">
                        <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="hidden-md-down">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header text-xs-center">
                                <strong>{{ __('words.languages') }}</strong>
                            </div>
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                                <div class="divider"></div>
                            @endforeach
                        </div>
                    </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}"><i
                        class="icon-speedometer"></i>{{ __('words.dashboard home') }}</a>
            </li>

            <li class="nav-title">
                {{ __('words.items') }}
            </li>
            @can('view', $setting)
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i
                            class="icon-puzzle"></i>{{ __('words.categories') }}</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index') }}"><i
                                    class="icon-puzzle"></i>{{ __('words.categories menu') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.create') }}"><i
                                    class="icon-puzzle"></i>{{ __('words.add category') }}</a>
                        </li>
                    </ul>
                </li>
            @endcan
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i
                        class="icon-puzzle"></i>{{ __('words.posts') }}</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index') }}"><i
                                class="icon-puzzle"></i>{{ __('words.posts menu') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.create') }}"><i
                                class="icon-puzzle"></i>{{ __('words.add post') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i
                        class="icon-puzzle"></i>{{ __('words.users') }}</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}"><i
                                class="icon-puzzle"></i>{{ __('words.users menu') }}</a>
                    </li>

            @can('view', $setting)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.create') }}"><i
                                class="icon-puzzle"></i>{{ __('words.add user') }}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-title">
                {{ __('words.settings') }}
            </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('settings.index') }}"><i
                            class="icon-docs"></i>{{ __('words.settings') }}</a>
                </li>
            @endcan
    </nav>
</div>
