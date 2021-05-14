<div id="main-menu" class="main-menu collapse navbar-collapse">
    <ul class="nav navbar-nav">
        <li class="active">
            <a href="{{ route('dashboard.index') }}"> <i class="fa fa-dashboard"></i>&nbsp;&nbsp;&nbsp;Dashboard </a>
        </li>
        <li class="active">
            <a href="/"><i class="fab fa-pagelines"></i>&nbsp;&nbsp;&nbsp;Pages </a>
        </li>
        @foreach($roles as $role)
            @foreach($role->users as $user)
                @if(Auth::user()->id == $user->id)
                    <h3 class="menu-title">{{ $role->title }}</h3><!-- /.menu-title -->
                    @if(count($role->permissions)>0)
                        @foreach($role->permissions as $permission)
                            @if($permission ->name != "Logout")
                                <li class="menu-item-has-children dropdown">
                                    @if($permission->parent == 0)
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">&nbsp;&nbsp;&nbsp;{!! $permission->icon !!}&nbsp;&nbsp;&nbsp;{{ $permission->name }}</a>
                                        <ul class="sub-menu children dropdown-menu">
                                            @foreach($role->permissions as $permission_c)
                                                @if($permission_c->parent == $permission->id )
                                                    @if($permission_c ->name != "Logout")
                                                    <li><a href="{{ route( $permission_c->url ) }}">{!! $permission_c->icon !!}{{ $permission_c->name }}</a></li>
                            @else
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i><span class="ml-1">{{ __('Logout') }}</span></a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endif
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @else

                            @endif
                        @endforeach
                    @else

                    @endif

                @else

                @endif
            @endforeach
        @endforeach
    </ul>
</div><!-- /.navbar-collapse -->
