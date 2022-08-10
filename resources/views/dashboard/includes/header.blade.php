<header class="navbar">
    <div class="container-fluid">
        <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
        <a class="navbar-brand" href="#" style="background-image: url({{ asset($setting->logo) }});"></a>
        <ul class="nav navbar-nav hidden-md-down">
            <li class="nav-item">
                <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
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
        </ul>
        <ul class="nav navbar-nav {{ app()->getlocale() == 'ar' ? 'pull-left' : 'pull-right' }}  hidden-md-down">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="true" aria-expanded="false">
                    @if(!auth()->user()->avatar)
                    <img src="{{ asset('dashboard/img/avatars/default.png') }}" class="img-avatar" alt="{{ auth()->user()->email }}">
                    @else 
                    <img src="{{ asset(auth()->user()->avatar) }}" class="img-avatar" alt="{{ auth()->user()->email }}" style="
                    width: 50px;
                    height: 50px;
                    border: 2px solid #eee;
                ">
                    @endif
                    <span class="hidden-md-down">{{ __('words.' . auth()->user()->status) }}</span>
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

        </ul>
    </div>
</header>
