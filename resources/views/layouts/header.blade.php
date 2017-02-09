<nav class="navbar navbar-default" style="border-radius: 0px 0px 0px 0px; background-color: white;">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="{{ URL::to('/') }}/logo_4.png" alt="Brand" style="margin-top: -1.2rem; width: 125px; height: 43px;">
            </a>
            <a class="navbar-brand" href="{{ route('home') }}" style="margin-left: -2rem;">WorthRand - CRM</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                @else
                    <p class="navbar-text" style="margin-top: 1.65rem;">Welcome,</p>
                    <li class="dropdown">
                    <button href="#" style="outline: none; text-shadow: none; font-size: 14px;" class="btn btn-default navbar-btn btn-sm dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <span class="caret"></span></button>
                        <ul class="dropdown-menu" style="margin-top: -0.30rem; margin-right: -2.5rem;">
                            <li><a href="{{ route(Auth::user()->role . '_user_profile') }}"><i class="fa fa-user"></i>&nbsp;&nbsp;Profile</a></li>

                            <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Logout</a></li>
                        </ul>
                    </li>
                    <li class="menu-divider"></li>
                    <button href="#" style="outline: none; text-shadow: none; font-size: 14px;" class="btn btn-default navbar-btn btn-sm"><i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp;&nbsp;Help</button>
                    <button href="#" style="outline: none; text-shadow: none; font-size: 14px;" class="btn btn-default navbar-btn btn-sm"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;Report an issue</button>
                    <button href="#" style="outline: none; text-shadow: none; font-size: 14px;" class="btn btn-default navbar-btn btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Patch Notes</button>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>