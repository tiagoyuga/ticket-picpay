@extends('panel._layouts.panel')

@section('_titulo_pagina_', (isset($item) ? 'Edit' : 'Create') . ' '.$label)

@section('content')

    @include('panel.tickets.nav')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

            <div class="col-lg-12">
                <div class="ibox">

                    <div class="ibox-title">
                        <h5>Change ticket status</h5>

                        <div class="ibox-tools">
                            <a class="collapse-link ui-sortable">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel blank-panel">

                                    <div class="panel-body">

                                        <form method="post" class="form-horizontal" id="frm_save" autocomplete="off"
                                              enctype="multipart/form-data"
                                              action="{{ isset($item) ? route('tickets.update', $item->id) : route('tickets.store') }}">
                                        {{ method_field(isset($item) ? 'PUT' : 'POST') }}
                                        {{ csrf_field() }}

                                        <!-- inicio dos campos -->

                                            <div class="form-row">

                                                <div
                                                    class="form-group col-md-12 @if ($errors->has('content')) has-error @endif">
                                                    <label for="content"><h3>Review</h3></label>
                                                    <textarea required rows="14" cols="50" name="content" id="content"
                                                              class="froalaEditor form-control">{{ old('content') }}</textarea>
                                                    {!! $errors->first('content','<span class="help-block m-b-none">:message</span>') !!}
                                                </div>

                                                <input type="hidden" name="ticket_id" value="{{ $item->id }}">

                                            </div>

                                            <div class="form-row">

                                                <div class="form-group col-md-4 @if ($errors->has('user_id')) has-error @endif">
                                                    <label for="group_id">Responsible programmer</label>

                                                    <select  class="select2 form-control form-control-lg" style="width: 100%"
                                                             name="dev_id"
                                                             id="dev_id" required>
                                                        <option value="">Select</option>

                                                        @foreach($devs as $id => $name)
                                                            <option
                                                                value="{{ $id }}" {{ old('dev_id', (isset($item) ? $item->dev_id : '')) == $id ? 'selected' : null }}>
                                                                {{ $name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    {!! $errors->first('dev_id','<span class="help-block m-b-none">:message</span>') !!}

                                                </div>


                                            </div>


                                            <div class="form-row">

                                                <div class="form-group col-md-4 @if ($errors->has('ticket_status_id')) has-error @endif">
                                                    <label for="group_id">Status</label>

                                                    <select  class="select2 form-control form-control-lg" style="width: 100%"
                                                             name="ticket_status_id"
                                                             id="ticket_status_id" required>
                                                        <option value="">Select</option>

                                                        @foreach($status as $id => $name)
                                                            <option
                                                                value="{{ $id }}" {{ old('ticket_status_id', (isset($item) ? $item->ticket_status_id : '')) == $id ? 'selected' : null }}>
                                                                {{ $name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    {!! $errors->first('ticket_status_id','<span class="help-block m-b-none">:message</span>') !!}

                                                </div>


                                            </div>

                                            <button class="btn btn-primary" id="" type="submit">
                                                <i class="fa fa-save"></i>
                                                Update ticket
                                            </button>

                                            <!-- FIM -->
                                        </form>

                                    </div>
                                </div>
                            </div>
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
    @include('panel._assets.scripts-froala')
@endsection
