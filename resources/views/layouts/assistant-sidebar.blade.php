<div class="sidebar col-lg-2 col-md-3 col-sm-3 col-xs-12 ">
   <ul id="accordion" class="nav nav-pills nav-stacked  sidebar-menu">
      <li class="nav-item {{ Request::route()->getName() == 'assistant_dashboard' ? 'active' : '' }}"><a class="nav-link" href="{{ route('assistant_dashboard') }}" class="nav-link"><i class="fa fa-tachometer"></i>&nbsp; Dashboard</a></li>
      {{--<li class="nav-item {{ Request::route()->getName() == 'assistant_indented_proposal_index' ? 'active' : '' }}"><a href="{{ route('assistant_indented_proposal_index') }}"><i class="fa fa-star"></i>&nbsp;Indented Proposals</a></li>
      <li class="nav-item {{ Request::route()->getName() == 'assistant_buy_and_sell_proposal_index' ? 'active' : '' }}"><a href="{{ route('assistant_buy_and_sell_proposal_index') }}"><i class="fa fa-code-fork" aria-hidden="true"></i>&nbsp;Buy and Sell Proposals</a></li>--}}
   </ul>
</div>
