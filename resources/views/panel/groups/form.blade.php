@extends('panel._layouts.panel')

@section('_titulo_pagina_', (isset($item) ? 'Edit' : 'Create') . ' of '.$label)

@section('content')

    @include('panel.groups.nav')

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
                              action="{{ isset($item) ? route('groups.update', $item->id) : route('groups.store') }}">
                        {{ method_field(isset($item) ? 'PUT' : 'POST') }}
                        {{ csrf_field() }}

                        <!-- inicio dos campos -->

                            <div class="form-row">
                                <div class="form-group col-md-3 @if ($errors->has('name')) has-error @endif">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                    		value="{{ old('name', (isset($item) ? $item->name : '')) }}">
                                    {!! $errors->first('name','<span class="help-block m-b-none">:message</span>') !!}
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
                                <a class="btn btn-default" id="ln_listar_form" href="{{ route('groups.index') }}">
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
    {!! $validator->selector('#frm_save') !!}
@endsection
