<nav class="navbar-fixed-top navbar-default" style="background-color: white;box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12); border-radius: 0px 0px 0px 0px;">
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
                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello, {{ Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('logout') }}">Logout</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;Report an issue</a></li>
                <li><a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp;&nbsp;Help</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>