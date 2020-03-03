@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'Fill out the form below or Register from the link')

@section('content')

    @include('public-users.nav')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

            <div class="col-lg-12">

                <div class="ibox float-e-margins">

                    <div class="ibox-title">

                        <h3>Client {{ $user->name }}</h3>
                        <br>
                        <h5>@yield('_titulo_pagina_')</h5>
                        <br>

                        <span class="text-info">{{ url()->current() }}</span>

                        <div class="ibox-tools">
                            <a class="collapse-link ui-sortable">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                        <br>
                        <br>

                    </div>

                    <div class="ibox-content">

                        <form method="post" class="form-horizontal" id="frm_save" autocomplete="off"
                              action="{{ route('public_users.store') }}">
                        {{ method_field('POST') }}
                        {{ csrf_field() }}

                        <!-- inicio dos campos -->

                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <div class="form-row">

                                <div class="form-group col-md-4 @if ($errors->has('name')) has-error @endif">
                                    <label for="name">First Name <i class="text-danger">*</i></label>
                                    <input type="text" name="first_name" id="name" class="form-control"
                                           value="{{ old('first_name', (isset($item) ? $item->name : '')) }}">
                                    {!! $errors->first('name','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 @if ($errors->has('name')) has-error @endif">
                                    <label for="name">Last Name <i class="text-danger">*</i></label>
                                    <input type="text" name="last_name" id="name" class="form-control"
                                           value="{{ old('last_name', (isset($item) ? $item->name : '')) }}">
                                    {!! $errors->first('name','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-4 @if ($errors->has('job_title')) has-error @endif">
                                    <label for="name">Job Title <i class="text-danger">*</i></label>
                                    <input type="text" name="job_title" id="job_title" class="form-control"
                                           value="{{ old('job_title', (isset($item) ? $item->name : '')) }}">
                                    {!! $errors->first('job_title','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 @if ($errors->has('branch_location')) has-error @endif">
                                    <label for="branch_location">Branch Location <i class="text-danger">*</i></label>
                                    <select class="form-control form-control-lg select2" style="width: 100%"
                                            name="branch_location"
                                            id="branch_location"
                                    >
                                        <option value="">Select</option>


                                    </select>
                                    {!! $errors->first('branch_location','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-4 @if ($errors->has('phone1')) has-error @endif">
                                    <label for="name">Phone Number <i class="text-danger">*</i></label>
                                    <input type="text" name="phone1" id="phone1"
                                           class="form-control mask_phone_with_ddd_usa"
                                           value="{{ old('phone1', (isset($item) ? $item->name : '')) }}">
                                    {!! $errors->first('phone1','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 @if ($errors->has('phone2')) has-error @endif">
                                    <label for="name">Cell Phone <i class="text-danger">*</i></label>
                                    <input type="text" name="phone2" id="phone2"
                                           class="form-control mask_phone_with_ddd_usa"
                                           value="{{ old('phone2', (isset($item) ? $item->name : '')) }}">
                                    {!! $errors->first('phone2','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-8 @if ($errors->has('email')) has-error @endif">
                                    <label for="email">Email <i class="text-danger">*</i></label>
                                    <input type="email" name="email" id="email" class="form-control"
                                           value="{{ old('name', (isset($item) ? $item->email : '')) }}">
                                    {!! $errors->first('email','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-4 @if ($errors->has('password')) has-error @endif">
                                    <label for="password">Password <i class="text-danger">*</i></label>
                                    <input type="password" name="password" id="password" class="form-control"
                                           value="{{ old('password', (isset($item) ? $item->name : '')) }}">
                                    {!! $errors->first('password','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div
                                    class="form-group col-md-4 @if ($errors->has('password_confirmation')) has-error @endif">
                                    <label for="password_confirmation">Confirm Password <i
                                            class="text-danger">*</i></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="form-control"
                                           value="{{ old('password_confirmation', (isset($item) ? $item->name : '')) }}">
                                    {!! $errors->first('password_confirmation','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                            </div>

                            <hr>

                            @if(Auth::user())

                                <label class="radio-inline">
                                    <strong>Previlegies setup</strong>
                                </label>
                                <div class="form">

                                    <label class="radio-inline">
                                        <input type="radio" name="type" value="1">Admin
                                    </label>

                                    <span class="mt-2"></span>
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="type" value="2">Regular User
                                    </label>

                                    <br>
                                    <br>

                                </div>

                            @else
                                <input type="hidden" name="type" value="2">

                            @endif

                        <!-- fim dos campos -->

                            <input id="routeTo" name="routeTo" type="hidden" value="{{ old('routeTo', 'index') }}">
                            <button class="btn btn-primary" id="bt_salvar" type="submit">
                                <i class="fa fa-save"></i>
                                {{ isset($item) ? 'Save editions' : 'Save' }}
                            </button>

                            <!-- FIM -->
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('styles')

@endsection


@section('scripts')
    @include('panel._assets.scripts-form')
    @include('panel._assets.scripts-select2')
    <script type="text/javascript" src="{{ asset('js/custom-masks.js')}}"></script>
    {{--{!! $validator->selector('#frm_save') !!}--}}

    <script>

        $().ready(function () {

            performRemoteSearch({
                element: '#city_id',
                url: '{{ route('users.find') }}',
                textOption: function (item) {
                    return item.city + " - " + item.state;
                }
            });

        });

    </script>

@endsection
