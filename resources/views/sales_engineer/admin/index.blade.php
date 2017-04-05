@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
@if(Session::has('message'))
<div class="row" style="margin-top: -2rem;">
   <div class="alert alert-success alert-dismissible" role="alert" style="border-radius: 0px; border-radius: 0px; color: #224323; background-color: #cde6cd;border-color: #bcddbc; background-image: none;">
      <i class="fa fa-check" style="margin-left: 18rem;"></i>&nbsp;&nbsp;<b>{{ Session::get('message') }}</b>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right: 15rem;"><span aria-hidden="true">&times;</span></button>
   </div>
</div>
@endif

<div class="col-lg-12">
        @include('layouts.admin-sidebar')
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                        <h4><i class="fa fa-certificate" aria-hidden="true"></i>&nbsp;&nbsp;SALES ENGINEERS</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">ID</th>
                            <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Date Added</th>
                            <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Name</th>
                            <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">E-mail</th>
                            <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Account Status</th>
                            <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;" class="text-center">Actions</th>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $user->id }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ date('m/d/Y', strtotime($user->created_at)) }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $user->name }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $user->email }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{!! $user->is_active == 1 ? '<label class="label label-success">ACTIVE</label>' : '<label class="label label-danger">DEACTIVATED</label>' !!}</b></td>
                                    <td class="text-center">
                                        <a id="viewBtn" href="{{ route('admin_show_sales_engineer', $user->id) }}" style="font-size: 15px;" title="View Profile"><i class="fa fa-search"></i></a>
                                        @if($user->isActivate())
                                            <a id="deactivateBtn" data-href="{{ route('admin_deactivate_se', $user->id) }}" style="font-size: 15px; cursor: pointer;" title="Deactive Account" data-toggle="modal" data-target="#DeactivateModal"><i class="fa fa-power-off" aria-hidden="true"></i></a>
                                        @else
                                            <a id="activateBtn" data-href="{{ route('admin_activate_se', $user->id) }}" style="font-size: 15px; cursor: pointer;" title="Active Account" data-toggle="modal" data-target="#ActivateModal"><i class="fa fa-fire" aria-hidden="true"></i></a>
                                        @endif
                                        <a id="deleteBtn" data-href="{{ route('admin_delete_se', $user->id) }}" style="font-size: 15px; cursor: pointer;" title="Delete" data-toggle="modal" data-target="#DeleteModal"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                        <form class="form-inline">
                            <div class="form-group left" style=" margin-top: 2.55rem; ">
                                <label class="" for="">Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} out of {{ $users->total() }} Sales Engineer(s)</label>
                            </div>
                            {{-- <div class="form-group right">
                                <span class="right">{!! $users->appends(['filter' => Request::get('filter')])->render() !!}</span>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="ActivateModal">
    <form method="POST" id="ActivateForm">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Activate Sales Engineer</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to activate this Sales Engineer's Account?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Activate</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="DeactivateModal">
    <form method="POST" id="DeactivateForm">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Deactivate Sales Engineer</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to deactivate this Sales Engineer's Account?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Deactivate</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="DeleteModal">
    <form method="POST" id="DeleteForm">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Sales Engineer</h4>
                </div>
                <div class="modal-body">
                    <p><code>Are you sure you want to delete this Sales Engineer?</code></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->

<script>
$(document).ready(function() {
    $('#deleteBtn').click(function() {
        document.getElementById('DeleteForm').action = $(this).data('href');
    });

    $("#deactivateBtn").click(function() {
        document.getElementById('DeactivateForm').action = $(this).data('href');
    });

    $("#activateBtn").click(function() {
        document.getElementById('ActivateForm').action = $(this).data('href');
    });
});
</script>
@endsection
