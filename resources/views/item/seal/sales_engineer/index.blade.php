@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @include('layouts.se-sidebar')
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="row">
                <div class="panel panel-default">

                    <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                        <h4><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;SEALS</h4>
                    </div>
                </div>
            </div>

            @if(count($seals) != 0)
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{ route('create_after_market') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add AfterMarket</a>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Date Added</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Name</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Model</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Material Number</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Tag Number</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Drawing Number</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Actions</th>
                            </thead>
                            <tbody>
                            @foreach($seals as $seal)
                                <tr>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ date('m/d/Y', strtotime($seal->created_at)) }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $seal->name }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $seal->model }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $seal->serial_number }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $seal->tag }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $seal->drawing_number }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;" class="text-center">
                                        <a href="{{ route('se_show_seal', $seal->id) }}" title="View {{ $seal->name }}"><i class="fa fa-search"></i></a>
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
                    </div>
                </div>
            </div>
            @else
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert search-error" role="alert" ><b>You have 0 records for Seals.</b></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
