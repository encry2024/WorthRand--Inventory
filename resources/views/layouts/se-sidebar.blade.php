<div class="col-md-3">
   <div class="list-group">
      <a href="{{ route('se_dashboard') }}" class="list-group-item {!! Request::route()->getName() == 'se_dashboard' ? 'active' : '' !!}" style="font-size: 13px;">
         <i class="fa fa-th-large" aria-hidden="true"></i>&nbsp;&nbsp;Dashboard
      </a>
      <a href="{{ route('customer_index') }}" class="list-group-item {!! Request::route()->getName() == 'customer_index' ? 'active' : '' !!}" style="font-size: 13px;"><i class="fa fa-users"></i>&nbsp;&nbsp;My Customers</a>
      <a href="{{ route('se_project_index') }}" class="list-group-item {!! Request::route()->getName() == 'se_project_index' ? 'active' : '' !!}" style="font-size: 13px;"><i class="fa fa-cog"></i>&nbsp;&nbsp;Project List</a></li>
      <a href="{{ route('aftermarket_index') }}" class="list-group-item {!! Request::route()->getName() == 'aftermarket_index' ? 'active' : '' !!}" style="font-size: 13px;"><i class="fa fa-cogs"></i>&nbsp;&nbsp;AfterMarket List</a>
      <a href="{{ route('se_seal_index') }}" class="list-group-item {!! Request::route()->getName() == 'se_seal_index' ? 'active' : '' !!}"><i class="fa fa-file-text-o" style="font-size: 13px;"></i>&nbsp;&nbsp;Seal List</a>
      <a href="{{ route('search') }}" class="list-group-item {!! Request::route()->getName() == 'search' ? 'active' : '' !!}" style="font-size: 13px;"><i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;&nbsp;Make A Proposal</a>
   </div>
</div>
