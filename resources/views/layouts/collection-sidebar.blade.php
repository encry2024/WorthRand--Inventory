<div class="sidebar col-lg-2 col-md-3 col-sm-3 col-xs-12 ">
   <ul id="accordion" class="nav nav-pills nav-stacked  sidebar-menu">
      <li class="nav-item {{ Request::route()->getName() == 'collection_dashboard' ? 'active' : '' }}"><a class="nav-link" href="{{ route('collection_dashboard') }}" class="nav-link"><i class="fa fa-tachometer"></i>&nbsp; Dashboard</a></li>

      <li class="nav-item {{ Request::route()->getName() == 'index_indented_proposal' ? 'active' : ''}}"><a href="{{ route('index_indented_proposal') }}"><i class="fa fa-star"></i>&nbsp;Indented Proposal</a></li>
      {{--<li class="nav-item {{ Request::route()->getName() == 'index_buy_and_sell_proposal' ? 'active' : ''}}"><a href="{{ route('index_buy_and_sell_proposal') }}"><i class="fa fa-code-fork" aria-hidden="true"></i>&nbsp;Buy and Sell Proposal</a></li>--}}
   </ul>
</div>
