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
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @include('layouts.admin-sidebar')
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                        <h4><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;SEALS</h4>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin_seal_create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add Seal</a>
            <hr>
            
            @if(count($seals) != 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">ID</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Name</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Size</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Seal Type</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Model</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Material Number</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Date Added</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Actions</th>
                            </thead>
                            <tbody>
                            @foreach($seals as $seal)
                                <tr>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ ((($seals->currentPage() - 1) * $seals->perPage()) + ($ctr++) + 1) }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $seal->name }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $seal->size }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $seal->seal_type }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $seal->model }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $seal->material_number }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ date('m/d/Y', strtotime($seal->created_at)) }}</b></td>
                                    <td class="text-center">
                                        <a href="{{ route('admin_seal_show', $seal->id) }}" title="View {{ $seal->name }}"><i class="fa fa-search"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <form class="form-inline">
                            <div class="form-group left" style=" margin-top: 2.55rem; ">
                                <label class="" for="">Showing {{ $seals->firstItem() }} to {{ $seals->lastItem() }} out of {{ $seals->total() }} Seal(s)</label>
                            </div>
                            {{-- <div class="form-group right">
                                <span class="right">{!! $seals->appends(['filter' => Request::get('filter')])->render() !!}</span>
                            </div> --}}
                        </form>
                        {{ $seals->links() }}
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert search-error" role="alert"><b>You have 0 records for Seals.</b></div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
