@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'Profile')

@section('content')

    @include('panel.users.nav')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

            <div class="col-md-12 ">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Skills from {{ $item->name }}</h3>
                    </div>
                    <div class="ibox-content">
                        <h5>Rate your skills from 0 to 10</h5>

                        <div class="hr-line-dashed"></div>
                        <form method="post" class="" id="frm_save" autocomplete="off"
                              action="{{ route('users.updateSkills', $item->id) }}">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}

                            @include('panel._layouts._partials.skills', [$skillList, $userQualifications, 'user' => $item])

                            <div class="hr-line-dashed"></div>

                            <button class="btn btn-primary" id="bt_salvar_adicionar" type="submit">
                                <i class="fa fa-save"></i>
                                Save
                            </button>

                            <a class="btn btn-default" id="ln_listar_form" href="{{ route('users.index') }}">
                                <i class="fa fa-list-ul"></i>
                                List
                            </a>


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
{{--    {!! $validator->selector('#frm_save') !!}--}}
@endsection
