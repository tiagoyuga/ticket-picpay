@extends('panel._layouts.panel')

@section('_titulo_pagina_', (isset($item) ? 'Edit' : 'Create') . ' of '.$label)

@section('content')

    @include('panel.users.nav')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>@yield('_titulo_pagina_')</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link ui-sortable">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        @if (Auth::user()->is_dev && count($errors) > 0)
                            <div class="alert alert-danger dev-mod">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="post" class="form-horizontal" id="frm_save" autocomplete="off"
                              action="{{ isset($item) ? route('users.update', $item->id) : route('users.store') }}">
                        {{ method_field(isset($item) ? 'PUT' : 'POST') }}
                        {{ csrf_field() }}

                        <!-- inicio dos campos -->

                            <div class="form-row">
                                <div class="form-group col-md-4 @if ($errors->has('group_id')) has-error @endif">
                                    <label for="group_id">Group <i class="text-danger">*</i></label>
                                    <select class="form-control form-control-lg" style="width: 100%"
                                            name="group_id"
                                            id="group_id">
                                        <option value="">Select</option>

                                        @foreach($groupList as $id => $name)
                                            <option
                                                value="{{ $id }}" {{ old('group_id', (isset($item) ? $item->group_id : '')) == $id ? 'selected' : null }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('group_id','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 @if ($errors->has('name')) has-error @endif">
                                    <label for="name">Name <i class="text-danger">*</i></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                           value="{{ old('name', (isset($item) ? $item->name : '')) }}">
                                    {!! $errors->first('name','<span class="help-block m-b-none">:message</span>') !!}
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-4 @if ($errors->has('email')) has-error @endif">
                                    <label for="email">E-mail <i class="text-danger">*</i></label>
                                    <input type="text" name="email" id="email" class="form-control"
                                           value="{{ old('email', (isset($item) ? $item->email : '')) }}">
                                    {!! $errors->first('email','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 @if ($errors->has('phone1')) has-error @endif">
                                    <label for="phone1">Phone</label>
                                    <input type="text" name="phone1" id="phone1" class="form-control mask_phone_with_ddd_usa"
                                           value="{{ old('phone1', (isset($item) ? $item->phone1 : '')) }}">
                                    {!! $errors->first('phone1','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4 @if ($errors->has('password')) has-error @endif">
                                    <label for="password">Password <i class="text-danger">*</i></label>
                                    <input type="password" name="password" id="password" class="form-control"
                                           value="">
                                    {!! $errors->first('password','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div
                                    class="form-group col-md-4 @if ($errors->has('password_confirmation')) has-error @endif">
                                    <label for="password">Confirm Password <i class="text-danger">*</i></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="form-control"
                                           value="">
                                    {!! $errors->first('password_confirmation','<span class="help-block m-b-none">:message</span>') !!}
                                </div>
                            </div>

                            <!-- fim dos campos -->

                            <input id="routeTo" name="routeTo" type="hidden" value="{{ old('routeTo', 'index') }}">
                            <button class="btn btn-primary" id="bt_salvar" type="submit">
                                <i class="fa fa-save"></i>
                                {{ isset($item) ? 'Save' : 'Save' }}
                            </button>

                            @if(!isset($item))
                                <button class="btn btn-default" id="bt_salvar_adicionar" type="submit">
                                    <i class="fa fa-save"></i>
                                    Save and add new
                                </button>
                            @else
                                <a class="btn btn-default" id="ln_listar_form" href="{{ route('users.index') }}">
                                    <i class="fa fa-list-ul"></i>
                                    List
                                </a>
                        @endif
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
    <script type="text/javascript" src="{{ asset('js/custom-masks.js')}}"></script>
    {!! $validator->selector('#frm_save') !!}

@endsection
