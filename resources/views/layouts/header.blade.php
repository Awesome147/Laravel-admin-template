<header>
    <div class="container">
        <div class="header">
            <div class="logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/app_prepreso.png') }}" alt="logo"/>
                   
                </a>
            </div>
<div class="mobile_menu">
      <span></span>
      <span></span>
      <span></span>
</div>
            <div class="navbar-nav ml-auto menus">              
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" style="cursor: pointer" data-toggle="modal" data-target="#loginModal">{{ __('Login') }}</a>
                            </li>
        
                                <li class="nav-item">
                                    <a class="nav-link" style="cursor: pointer" data-toggle="modal" data-target="#registerModal">{{ __('Register') }}</a>
                                </li>
                     
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ url('/profile') }}">
                                    {{ Auth::user()->name }}                                 </a>

                                                           </li>
                            @if(auth()->user()->hasRole('authenticated') !== null && auth()->user()->hasRole('authenticated') && !auth()->user()->hasRole('administrator'))
                            <li class="nav-item">
                                   
                                        <a class="nav-link " href="{{ url('/subscription') }}">{{ __('views.subscription.title') }}</a>
                                  
                            </li>
 				<li class="nav-item">
                                   
                                     <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                        @csrf
                                    </form>
                                  
                            </li>

                              @endif
                            @if(auth()->user()->hasRole('administrator'))
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ url('/admin') }}">{{ __('views.welcome.admin') }}</a>
                            </li>
<li class="nav-item">
                                   
                                     <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                        @csrf
                                    </form>
                                  
                            </li>

                             @endif
                        @endguest
                    </ul>
            </div>
        </div>
    </div>
</header>

