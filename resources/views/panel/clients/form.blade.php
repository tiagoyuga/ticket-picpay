@extends('panel._layouts.panel')

@section('_titulo_pagina_', (isset($item) ? 'Edit' : 'Create') . ' of '.$label)

@section('content')

    @include('panel.clients.nav')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>@yield('_titulo_pagina_')</h5>
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
                              action="{{ isset($item) ? route('clients.update', $item->id) : route('clients.store') }}">
                        {{ method_field(isset($item) ? 'PUT' : 'POST') }}
                        {{ csrf_field() }}

                        <!-- inicio dos campos -->

                            <div class="card">
                                <div class="card-header">
                                    Company Information
                                </div>
                                <div class="card-body">

                                    <div class="form-row">
                                        <div class="form-group col-md-8 @if ($errors->has('clients')) has-error @endif">
                                            <label for="group_id">CEO / Manager <i
                                                    class="text-danger">*</i></label>
                                            <select class="select2 form-control form-control-lg" style="width: 100%"
                                                    name="clients[]"
                                                    multiple
                                                    id="clients">
                                                <option value="">Select</option>

                                                @foreach($clientsList as $key=>$value)
                                                    <option
                                                        value="{{ $key }}" {{ isset($item) && $item->usersTypeClient->contains($key) ? 'selected' : ''}}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            {!! $errors->first('clients','<span class="help-block m-b-none">:message</span>') !!}
                                        </div>


                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-8 @if ($errors->has('users')) has-error @endif">
                                            <label for="group_id">Users who can chat with the customer <i
                                                    class="text-danger">*</i></label>
                                            <select class="select2 form-control form-control-lg" style="width: 100%"
                                                    name="users[]"
                                                    multiple
                                                    id="users">
                                                <option value="">Select</option>

                                                @foreach($usersList as $key=>$value)
                                                    <option
                                                        value="{{ $key }}" {{ isset($item) && $item->usersTypeUser->contains($key) ? 'selected' : ''}}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            {!! $errors->first('users','<span class="help-block m-b-none">:message</span>') !!}
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div
                                            class="form-group col-md-4 @if ($errors->has('company_name')) has-error @endif">
                                            <label for="company_name">Company name</label>
                                            <input type="text" name="company_name" id="company_name"
                                                   class="form-control"
                                                   value="{{ old('company_name', (isset($item) ? $item->company_name : '')) }}">
                                            {!! $errors->first('company_name','<span class="help-block m-b-none">:message</span>') !!}
                                        </div>

                                        <div
                                            class="form-group col-md-4 @if ($errors->has('contact_name')) has-error @endif">
                                            <label for="contact_name">Company contact name</label>
                                            <input type="text" name="contact_name" id="contact_name"
                                                   class="form-control"
                                                   value="{{ old('contact_name', (isset($item) ? $item->contact_name : '')) }}">
                                            {!! $errors->first('contact_name','<span class="help-block m-b-none">:message</span>') !!}
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div
                                            class="form-group col-md-4 @if ($errors->has('cell_phone')) has-error @endif">
                                            <label for="cell_phone">Cell phone</label>
                                            <input type="text" name="cell_phone" id="cell_phone"
                                                   class="form-control mask_phone_with_ddd_usa"
                                                   value="{{ old('cell_phone', (isset($item) ? $item->cell_phone : '')) }}">
                                            {!! $errors->first('cell_phone','<span class="help-block m-b-none">:message</span>') !!}
                                        </div>


                                        <div
                                            class="form-group col-md-4 @if ($errors->has('additional_phone')) has-error @endif">
                                            <label for="additional_phone">Additional Phone</label>
                                            <input type="text" name="additional_phone" id="additional_phone"
                                                   class="form-control mask_phone_with_ddd_usa"
                                                   value="{{ old('additional_phone', (isset($item) ? $item->additional_phone : '')) }}">
                                            {!! $errors->first('additional_phone','<span class="help-block m-b-none">:message</span>') !!}
                                        </div>


                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-4 @if ($errors->has('email')) has-error @endif">
                                            <label for="email">Company e-mail</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                   value="{{ old('email', (isset($item) ? $item->email : '')) }}">
                                            {!! $errors->first('email','<span class="help-block m-b-none">:message</span>') !!}
                                        </div>

                                        <div
                                            class="form-group col-md-4 @if ($errors->has('additional_email')) has-error @endif">
                                            <label for="additional_email">Additional e-mail</label>
                                            <input type="email" name="additional_email" id="additional_email"
                                                   class="form-control"
                                                   value="{{ old('additional_email', (isset($item) ? $item->additional_email : '')) }}">
                                            {!! $errors->first('additional_email','<span class="help-block m-b-none">:message</span>') !!}
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-4 @if ($errors->has('address')) has-error @endif">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" id="address" class="form-control"
                                                   value="{{ old('address', (isset($item) ? $item->address : '')) }}">
                                            {!! $errors->first('address','<span class="help-block m-b-none">:message</span>') !!}
                                        </div>

                                        <div
                                            class="form-group col-md-4 @if ($errors->has('zip_code')) has-error @endif">
                                            <label for="zip_code">Zip code</label>
                                            <input type="text" name="zip_code" id="zip_code"
                                                   class="form-control"
                                                   value="{{ old('zip_code', (isset($item) ? $item->zip_code : '')) }}">
                                            {!! $errors->first('zip_code','<span class="help-block m-b-none">:message</span>') !!}
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div
                                            class="form-group col-md-4 @if ($errors->has('cto_amount')) has-error @endif">
                                            <label for="cell_phone">CTO % Amount</label>
                                            <input type="text" name="cto_amount"
                                                   id="cto_amount" class="form-control maskmoney_percent"
                                                   value="{{ old('cto_amount', (isset($item) ? $item->cto_amount : '')) }}">
                                            {!! $errors->first('cto_amount','<span class="help-block m-b-none">:message</span>') !!}
                                        </div>

                                        <div
                                            class="form-group col-md-4 @if ($errors->has('state')) has-error @endif">
                                            <label for="state">State <i
                                                    class="text-danger">*</i></label>
                                            <select class="form-control form-control-lg select2" style="width: 100%"
                                                    name="state"
                                                    id="state"
                                            >
                                                <option value="">Select</option>


                                            </select>
                                            {!! $errors->first('state','<span class="help-block m-b-none">:message</span>') !!}
                                        </div>

                                    </div>

                                </div>
                            </div>

                            @if(!isset($item))

                                <hr>

                                <div class="card">
                                    <div class="card-header">
                                        Company Staff
                                    </div>
                                    <div class="card-body">

                                        <div class="form-row">

                                            <div
                                                class="form-group col-md-4 @if ($errors->has('name')) has-error @endif">
                                                <label for="name">First Name <i class="text-danger">*</i></label>
                                                <input required type="text" name="first_name" id="name" class="form-control"
                                                       value="{{ old('first_name', (isset($item) ? $item->name : '')) }}">
                                                {!! $errors->first('name','<span class="help-block m-b-none">:message</span>') !!}
                                            </div>

                                            <div
                                                class="form-group col-md-4 @if ($errors->has('name')) has-error @endif">
                                                <label for="name">Last Name <i class="text-danger">*</i></label>
                                                <input required type="text" name="last_name" id="name" class="form-control"
                                                       value="{{ old('last_name', (isset($item) ? $item->name : '')) }}">
                                                {!! $errors->first('name','<span class="help-block m-b-none">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div
                                                class="form-group col-md-8 @if ($errors->has('job_title')) has-error @endif">
                                                <label for="name">Job Title <i class="text-danger">*</i></label>
                                                <input required type="text" name="job_title" id="job_title" class="form-control"
                                                       value="{{ old('job_title', (isset($item) ? $item->name : '')) }}">
                                                {!! $errors->first('job_title','<span class="help-block m-b-none">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div
                                                class="form-group col-md-4 @if ($errors->has('phone1')) has-error @endif">
                                                <label for="name">Phone Number </label>
                                                <input type="text" name="phone1" id="phone1"
                                                       class="form-control mask_phone_with_ddd_usa"
                                                       value="{{ old('phone1', (isset($item) ? $item->name : '')) }}">
                                                {!! $errors->first('phone1','<span class="help-block m-b-none">:message</span>') !!}
                                            </div>

                                            <div
                                                class="form-group col-md-4 @if ($errors->has('phone2')) has-error @endif">
                                                <label for="name">Cell Phone </label>
                                                <input type="text" name="phone2" id="phone2"
                                                       class="form-control mask_phone_with_ddd_usa"
                                                       value="{{ old('phone2', (isset($item) ? $item->name : '')) }}">
                                                {!! $errors->first('phone2','<span class="help-block m-b-none">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="form-group col-md-4 @if ($errors->has('email_user')) has-error @endif">
                                                <label for="email_user">Staff e-mail<i class="text-danger">*</i></label>
                                                <input required type="email" name="email_user" id="email_user" class="form-control"
                                                       value="{{ old('email_user', (isset($item) ? $item->email : '')) }}">
                                                {!! $errors->first('email_user','<span class="help-block m-b-none">:message</span>') !!}
                                            </div>

                                            <div
                                                class="form-group col-md-4 @if ($errors->has('additional_email_user')) has-error @endif">
                                                <label for="additional_email_user">Additional e-mail</label>
                                                <input  type="email" name="additional_email_user" id="additional_email_user"
                                                       class="form-control"
                                                       value="{{ old('additional_email_user', (isset($item) ? $item->additional_email : '')) }}">
                                                {!! $errors->first('additional_email_user','<span class="help-block m-b-none">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div
                                                class="form-group col-md-4 @if ($errors->has('password')) has-error @endif">
                                                <label for="password">Password <i class="text-danger">*</i></label>
                                                <input required type="password" name="password" id="password"
                                                       class="form-control"
                                                       value="{{ old('password', (isset($item) ? $item->name : '')) }}">
                                                {!! $errors->first('password','<span class="help-block m-b-none">:message</span>') !!}
                                            </div>

                                            <div
                                                class="form-group col-md-4 @if ($errors->has('password_confirmation')) has-error @endif">
                                                <label for="password_confirmation">Confirm Password <i
                                                        class="text-danger">*</i></label>
                                                <input required type="password" name="password_confirmation"
                                                       id="password_confirmation"
                                                       class="form-control"
                                                       value="{{ old('password_confirmation', (isset($item) ? $item->name : '')) }}">
                                                {!! $errors->first('password_confirmation','<span class="help-block m-b-none">:message</span>') !!}
                                            </div>

                                        </div>


                                    </div>
                                </div>

                            @endif

                            <hr>
                        <!-- fim dos campos -->
                            <input type="hidden" name="type" value="1">
                            <input id="routeTo" name="routeTo" type="hidden" value="{{ old('routeTo', 'index') }}">
                            <button class="btn btn-primary" id="bt_salvar" type="submit">
                                <i class="fa fa-save"></i>
                                {{ isset($item) ? 'Save editions' : 'Save' }}
                            </button>

                            @if(!isset($item))
                                <button class="btn btn-default" id="bt_salvar_adicionar" type="submit">
                                    <i class="fa fa-save"></i>
                                    Save and add new
                                </button>
                            @else
                                <a class="btn btn-default" id="ln_listar_form" href="{{ route('clients.index') }}">
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
    <script type="text/javascript" src="{{ asset('js/custom-select2.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/custom-masks.js')}}"></script>
    {!! $validator->selector('#frm_save') !!}

    <script>

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "https://datausa.io/api/data?drilldowns=State&measures=Population&year=latest",
            data: '',
            success: function (data) {

                $("#state").select2({
                    //multiple: true,
                    data:
                        $.map(data.data, function (item) {
                            return {
                                text: item['State'],
                                id: item['ID State']
                            }
                        })
                });
            },
            error: function (error) {
                /*jsonValue = jQuery.parseJSON(error.responseText);
                alert("error" + error.responseText);*/
            }
        });

    </script>


@endsection
