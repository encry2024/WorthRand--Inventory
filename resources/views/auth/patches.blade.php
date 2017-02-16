@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin_dashboard') }}" class="list-group-item" style="font-size: 13px;">
                    <i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back
                </a>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1><small>Patch</small> - 0.4.0 - RELEASE</h1>
                    </div>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed incorrect computation for sales engineer's current sale.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed Collection's Dashboard Interface.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed Collection's Indented Proposal Interface.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed Collection's Buy And Resale Interface.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Collection may now collect sale from buy and resale proposal.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed inconsistent interface for messages.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Added view completed indented proposal.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Message confirmation before accepting proposals.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed pricing history for seal.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Seal is now included in proposals.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed minor bugs.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed Assistant's Dashboard Interface.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed Assistant's Indented Proposal Interface.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed Assistant's Buy And Resale Interface.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed Secretary's Dashboard Interface.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed Secretary's Indented Proposal Interface.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed Secretary's Buy And Resale Interface.</li></label><br>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1><small>Patch</small> - 0.3.0 - BETA</h1>
                    </div>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed bug in updating project's price on pricing history page.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed bug in updating seal's price on pricing history page.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed bug in updating aftermarket's price on pricing history page.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Redesign project's profile.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Redesign seal's profile.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Redesign aftermarket's profile.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Redesign project's pricing history page.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Redesign seal's pricing history page.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Redesign aftermarket's pricing history page.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed update project's information.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed update seal's information.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed update aftermarket's information.</li></label><br>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1><small>Patch</small> - 0.2.2 - BETA</h1>
                    </div>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Redesign Sales Engineer interface.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Added some functions and validation.</li></label><br>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Fixed some bugs.</li></label><br>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1><small>Patch</small> - 0.1.0 - BETA</h1>
                    </div>
                    <label style="font-size: 16px !important; font-weight: 400;"><li>Redesign admin interface</li></label>
                </div>
            </div>
        </div>
    </div>
@endsection
