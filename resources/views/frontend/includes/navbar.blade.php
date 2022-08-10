<!-- Navbar Start -->
<div class="container-fluid p-0 mb-3">
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-2 py-lg-0 px-lg-5">
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
            <div class="navbar-nav mr-auto py-0">
                <a href="{{ route('frontend') }}" class="nav-item nav-link active">{{ __('words.home') }}</a>
                @foreach ($categories as $category)
                        <div class="nav-item dropdown">
                            <a  @if (count($category->children) > 0) href="{{Route('category.frontend',$category->id)}}" @else href='#' @endif class="nav-link  @if (count($category->children) > 0) dropdown-toggle  @endif"
                                @if(count($category->children) > 0)  data-toggle="dropdown" @endif
                                 >{{ $category->title }}</a>
                            @if (count($category->children) > 0)
                                <div class="dropdown-menu rounded-0 m-0">
                                    @foreach ($category->children as $child)
                                        <a href="{{Route('category.frontend',$child->id)}}" class="dropdown-item">{{ $child->title }}</a>
                                    @endforeach


                                </div>
                            @endif
                        </div>
                    @endforeach
            </div>
        </div>
        <li class="nav-item p-x-1 nav-item dropdown" style="
        list-style: none;">
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
        @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-danger" > {{ __('words.login') }} </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-danger"
                            > {{ __('words.Register Now!') }} </a>
                        @endif
                    @endauth
                </div>
            @endif
    </nav>
</div>
<!-- Navbar End -->