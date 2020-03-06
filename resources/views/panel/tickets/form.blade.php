@extends('panel._layouts.panel')

@section('_titulo_pagina_', (isset($item) ? '' : 'Create') . ' '.$label)

@section('content')

    @include('panel.tickets.nav')

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
                              enctype="multipart/form-data"
                              action="{{ isset($item) ? route('tickets.update', $item->id) : route('tickets.store') }}">
                        {{ method_field(isset($item) ? 'PUT' : 'POST') }}
                        {{ csrf_field() }}

                        <!-- inicio dos campos -->

                            <div class="form-row">
                                <div
                                    class="form-group col-md-3 @if ($errors->has('client_id')) has-error @endif">
                                    <label for="priority">Company</label>

                                    @if(!isset($item))

                                        <select name="client_id" id="client_id" class="form-control">
                                            @foreach(\Auth::user()->clients as $client)
                                                <option class=""
                                                        value="{{ $client->id }}" {{ old('client_id', (isset($item) ? $item->client_id : '')) == $client->id ? 'selected' : '' }}>
                                                    {{ $client->company_name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        {!! $errors->first('client_id','<span class="help-block m-b-none">:message</span>') !!}

                                    @else
                                        <p>
                                            <strong>{{ $item->client->company_name }}</strong>
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12 @if ($errors->has('subject')) has-error @endif">
                                    <label for="subject">Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control"
                                           value="{{ old('subject', (isset($item) ? $item->subject : '')) }}">
                                    {!! $errors->first('subject','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-12 @if ($errors->has('content')) has-error @endif">
                                    <label for="content">Ticket description</label>
                                    <textarea rows="14" cols="50" name="content" id="content"
                                              class="ckeditor form-control">{{ old('content', (isset($item) ? $item->content : '')) }}</textarea>
                                    {!! $errors->first('content','<span class="help-block m-b-none">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-3 @if ($errors->has('priority')) has-error @endif">
                                    <label for="priority">Priority</label>

                                    <select name="priority" id="priority" class="form-control">

                                        @foreach(config('enums.priorities') as $i => $v)

                                            @php
                                                $color = ($i == 'low') ? 'blue' : ($i == 'medium' ? 'orange' : 'red');
                                            @endphp

                                            <option style="color:{{ $color }};font: bold;size: A3"
                                                value="{{ $i }}" {{ old('priority', (isset($item) ? $item->priority : '1')) == $i ? 'selected' : '' }}>
                                                {{ $v }}
                                            </option>
                                        @endforeach
                                    </select>

                                    {!! $errors->first('priority','<span class="help-block m-b-none">:message</span>') !!}

                                </div>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-3 @if ($errors->has('file')) has-error @endif">
                                    <label for="image">File</label>
                                    <input id="file" name="file" type="file"
                                           class="form-control required"
                                           accept="image/gif, image/jpeg, image/png, application/pdf"
                                    >
                                </div>

                            </div>

                            @if(isset($item))
                                <hr>
                                <div class="form-group row">

                                    <div class="col-sm-10">
                                        @if($item->ticket_status_id == \App\Models\TicketStatus::COMPLETED)
                                            <div><label>Reopen ticket <br><br><input type="checkbox" name="reopen"
                                                                                     value="reopen">
                                                    I confirm the ticket opening again </label></div>

                                        @else
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="completed"
                                                                                               value="completed">
                                                    Set Ticket as completed
                                                </label>
                                            </div>

                                        @endif
                                    </div>

                                </div>
                                <hr>
                            @endif
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
                                <a class="btn btn-default" id="ln_listar_form" href="{{ route('tickets.index') }}">
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
    <script src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'), {

                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'indent',
                        'outdent',
                        '|',
                        'blockQuote',
                        'insertTable',
                        'undo',
                        'redo'
                    ]
                },
                language: 'en',
                height: 300,
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },
                licenseKey: '',

            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    {!! $validator->selector('#frm_save') !!}
@endsection
