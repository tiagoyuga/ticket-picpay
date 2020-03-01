@php
    $userIsDev = Auth::user()->is_dev
@endphp

<div class="row border-bottom white-bg">
    <nav class="navbar navbar-expand-lg navbar-static-top" role="navigation">

        <a href="{{ route('dashboard') }}" class="navbar-brand text-center">
            CRM
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-reorder"></i>
        </button>

        <!--</div>-->
        <div class="navbar-collapse collapse" id="navbar">
            <ul class="nav navbar-nav mr-auto">

                <li class="{{ isActiveRoute('dashboard') }}">
                    <a aria-expanded="false" role="button" href="{{ route('dashboard') }}">
                        <i class="fa fa-home"></i>
                        <span class="nav-label">Início</span>
                    </a>
                </li>

{{--                <li>--}}
{{--                    <a aria-expanded="false" role="button" href="{{ route('dashboard.dashboard') }}">--}}
{{--                        <i class="fa fa-dashboard"></i>--}}
{{--                        <span class="nav-label">Dashboard</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

                @if(\Auth::user()->group_id == \App\Models\Group::ADMIN)

                    <li class="dropdown {{ isActiveRoute([
    'groups.*', 'users.*']) }}">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-gears"></i>
                            Configurations
                        </a>
                        <ul role="menu" class="dropdown-menu">

                            <li><a href="{{ route('groups.index') }}">Groups</a></li>
                            <li><a href="{{ route('users.index') }}">Users</a></li>
                            <li><a href="{{ route('clients.index') }}">Clients</a></li>

                        </ul>
                    </li>
                @endif

                <li>
                    <a aria-expanded="false" role="button" href="{{ route('tickets.index') }}">
                        <i class="fa fa-dashboard"></i>
                        <span class="nav-label">Tickets</span>
                    </a>
                </li>



            </ul>

            <form name="frm_new_users_notifications" id="frm_new_users_notifications">
                {{ method_field('POST') }}
                {{ csrf_field() }}
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome {{ \Auth::user()->name }}</span>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> Logout
                        </a>
                    </li>
                </ul>
            </form>
        </div>
    </nav>
</div>
