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
                            <div class="form-row">
                                <div class="form-group col-md-4 @if ($errors->has('user_id')) has-error @endif">
                                    <label for="group_id">Users responsible for the company <i class="text-danger">*</i></label>
                                    <select  class="select2 form-control form-control-lg" style="width: 100%"
                                            name="users[]"
                                             multiple
                                            id="user_id">
                                        <option value="">Select</option>

                                        @foreach($users as $key=>$value)
                                            <option
                                                value="{{ $key }}" {{ isset($item) && $item->users->contains($key) ? 'selected' : ''}}>
                                                {{ $value }}
                                            </option>
                                        @endforeach

                                    </select>
                                    {!! $errors->first('user_id','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 @if ($errors->has('email')) has-error @endif">
                                    <label for="email">Company e-mail</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                           value="{{ old('email', (isset($item) ? $item->email : '')) }}">
                                    {!! $errors->first('email','<span class="help-block m-b-none">:message</span>') !!}
                                </div>


                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4 @if ($errors->has('company_name')) has-error @endif">
                                    <label for="company_name">Company name</label>
                                    <input type="text" name="company_name" id="company_name" class="form-control"
                                           value="{{ old('company_name', (isset($item) ? $item->company_name : '')) }}">
                                    {!! $errors->first('company_name','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 @if ($errors->has('contact_name')) has-error @endif">
                                    <label for="contact_name">Company contact name</label>
                                    <input type="text" name="contact_name" id="contact_name" class="form-control"
                                           value="{{ old('contact_name', (isset($item) ? $item->contact_name : '')) }}">
                                    {!! $errors->first('contact_name','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-4 @if ($errors->has('cell_phone')) has-error @endif">
                                    <label for="cell_phone">Cell phone</label>
                                    <input type="text" name="cell_phone" id="cell_phone" class="form-control"
                                           value="{{ old('cell_phone', (isset($item) ? $item->cell_phone : '')) }}">
                                    {!! $errors->first('cell_phone','<span class="help-block m-b-none">:message</span>') !!}
                                </div>


                                <div
                                    class="form-group col-md-4 @if ($errors->has('additional_phone')) has-error @endif">
                                    <label for="additional_phone">Additional Phone</label>
                                    <input type="text" name="additional_phone" id="additional_phone"
                                           class="form-control"
                                           value="{{ old('additional_phone', (isset($item) ? $item->additional_phone : '')) }}">
                                    {!! $errors->first('additional_phone','<span class="help-block m-b-none">:message</span>') !!}
                                </div>


                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-4 @if ($errors->has('cto_amount')) has-error @endif">
                                    <label for="cell_phone">CTO % Amount</label>
                                    <input type="text"  name="cto_amount"
                                           id="cto_amount" class="form-control maskmoney_percent"
                                           value="{{ old('cto_amount', (isset($item) ? $item->cto_amount : '')) }}">
                                    {!! $errors->first('cto_amount','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                            </div>



                            <!-- fim dos campos -->

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


@endsection
