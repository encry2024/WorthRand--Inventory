<div class="col-md-3">
    <div class="list-group">
        <a href="{{ route('admin_dashboard') }}" class="list-group-item {!! Request::route()->getName() == 'admin_dashboard' ? 'active' : '' !!}" style="font-size: 13px;">
            <i class="fa fa-th-large" aria-hidden="true"></i>&nbsp;&nbsp;Dashboard
        </a>
        <a href="{{ route('admin_user_index') }}" class="list-group-item {!! Request::route()->getName() == 'admin_user_index' ? 'active' : '' !!}" style="font-size: 13px;"><i class="fa fa-users"></i>&nbsp;&nbsp;Users List</a>
        <a href="{{ route('admin_sales_engineer_index') }}" class="list-group-item {!! Request::route()->getName() == 'admin_sales_engineer_index' ? 'active' : '' !!}" style="font-size: 13px;"><i class="fa fa-certificate" aria-hidden="true"></i>&nbsp;&nbsp;Sales Engineer</a>
        <a class="list-group-item {!! Request::route()->getName() == 'admin_customer_index' ? 'active' : '' !!}""  href="{{ route('admin_customer_index') }}"><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;&nbsp;Customers</a>
        <a href="{{ route('admin_project_index') }}" class="list-group-item {!! Request::route()->getName() == 'admin_project_index' ? 'active' : '' !!}"><i class="fa fa-cog"></i>&nbsp;&nbsp;Project List</a></li>
        <a href="{{ route('admin_after_market_index') }}" class="list-group-item {!! Request::route()->getName() == 'admin_after_market_index' ? 'active' : '' !!}"><i class="fa fa-cogs"></i>&nbsp;&nbsp;AfterMarket List</a>
        <a href="{{ route('admin_seal_index') }}" class="list-group-item {!! Request::route()->getName() == 'admin_seal_index' ? 'active' : '' !!}"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;Seal List</a>
    </div>
</div>
