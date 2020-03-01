@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'Dashboard')

@section('content')

    <div class="wrapper wrapper-content animated fadeIn">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title"><h5>Dashboard</h5>
                        <div class="ibox-tools"></div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                            Bem vindo {{ \Auth::user()->name }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('css')
@endsection

@section('scripts')
@endsection

