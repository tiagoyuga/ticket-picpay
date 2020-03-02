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

                                        <form method="post" class="form-horizontal" id="frm_savee" autocomplete="off"
                                              enctype="multipart/form-data"
                                              action="{{ isset($item) ? route('tickets.update', $item->id) : route('tickets.store') }}">
                                        {{ method_field(isset($item) ? 'PUT' : 'POST') }}
                                        {{ csrf_field() }}

                                        <!-- inicio dos campos -->

                                            <div class="form-row">

                                                <div
                                                    class="form-group col-md-12 @if ($errors->has('content')) has-error @endif">
                                                    <label for="content"><h3>Review *</h3></label>
                                                    <textarea required rows="14" cols="50" name="review" id="review"
                                                              class=" form-control">{{ old('review') }}</textarea>
                                                    {!! $errors->first('review','<span class="help-block m-b-none">:message</span>') !!}
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
                                                <div class="form-group col-md-2 @if ($errors->has('dev_estimated_time')) has-error @endif">
                                                    <label for="name">Developer Estimated Hrs</label>
                                                    <input type="text" name="dev_estimated_time" id="dev_estimated_time" class="form-control mask_hour hour_change"
                                                           value="{{ old('dev_estimated_time', (isset($item) ? $item->dev_estimated_time : '')) }}">
                                                    {!! $errors->first('dev_estimated_time','<span class="help-block m-b-none">:message</span>') !!}
                                                </div>

                                                <div class="form-group col-md-1 @if ($errors->has('cto_hours')) has-error @endif">
                                                    <label for="name">CTO time</label>
                                                    <input type="text" name="cto_hours" id="cto_hours" class="form-control mask_hour"
                                                           value="{{ old('cto_hours', (isset($item) ? $item->cto_hours : '')) }}" >
                                                </div>

                                                <div class="form-group col-md-1 ">
                                                    <label for="name">CTO client %</label>
                                                    <input type="text" class="form-control "
                                                           value="{{ $item->client->cto_amount }} " disabled>
                                                </div>

                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4 @if ($errors->has('dev_hour_spent')) has-error @endif">
                                                    <label for="name">Dev hour Spent</label>
                                                    <input type="text" name="dev_hour_spent" id="dev_hour_spent" class="form-control mask_hour hour_change"
                                                           value="{{ old('dev_hour_spent', (isset($item) ? $item->dev_hour_spent : '')) }}">
                                                    {!! $errors->first('dev_hour_spent','<span class="help-block m-b-none">:message</span>') !!}
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
    </div>
@endsection


@section('styles')

@endsection


@section('scripts')
    @include('panel._assets.scripts-form')
    <script src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('js/custom-masks.js')}}"></script>
    <script>

        $(".hour_change").keyup(function () {

            let original_seconds = timestamp_to_seconds($(this).val());
            let minutes = (original_seconds / 60);

            let cto_hours =  secondsToTime((minutes * (0.10 ))*60)
            $("#cto_hours").val(cto_hours)

        })

        function timestamp_to_seconds(timestamp) {
            var [hours, minutes] = timestamp.split(':').map((t) => parseInt(t, 10));
            return 60 * minutes + 60 * 60 * hours;
        }

        function secondsToTime(secs)
        {
            var hours = Math.floor(secs / (60 * 60));

            var divisor_for_minutes = secs % (60 * 60);
            var minutes = (Math.floor(divisor_for_minutes / 60));
            minutes = minutes < 10 ? '0' + minutes : minutes;
            hours = hours < 10 ? '0' + hours : hours;


            if(isNaN(hours) || isNaN(minutes))
                return '00:00';

            return hours+':'+minutes;
        }


    </script>
@endsection
