
<div class="col-lg-3">
   <div class="list-group">
      <a href="{{ route('super_admin_dashboard') }}" class="white list-group-item {{ Request::route()->getName() == 'super_admin_dashboard' ? 'active' : '' }}" class="nav-link"><span class="glyphicon glyphicon-dashboard"></span>&nbsp; Dashboard</a>
      <a class="white list-group-item {{ Request::route()->getName() == 'super_admin_user_index' ? 'active' : '' }}" href="{{ route('super_admin_user_index') }}"><span class="glyphicon glyphicon-user"></span>&nbsp; User</a>
      <a class="white list-group-item" href="#"><i class="fa fa-users"></i>&nbsp; Sales Engineer</a>
      <a class="white list-group-item" href="#"><i class="fa fa-cog"></i>&nbsp; Projects</a>
      <a class="white list-group-item" href="#"><i class="fa fa-cogs"></i>&nbsp; Aftermarkets</a>
      <a class="white list-group-item" href="#"><i class="fa fa-file-text-o"></i>&nbsp; Seal</a>
   </div>
</div>
