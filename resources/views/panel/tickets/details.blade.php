@extends('panel._layouts.panel')

@section('_titulo_pagina_', (isset($item) ? 'Edit' : 'Create') . ' '.$label)

@section('content')

    @include('panel.tickets.nav')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="m-b-md">
                                    @can('update', $item)
                                    <a href="{{ route('tickets.edit', $item->id) }}" class="btn btn-white btn-xs float-right">Edit ticket</a>
                                    @endcan
                                    <h2>{{ $item->subject }}</h2>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right">
                                        <dt>Status:</dt>
                                    </div>
                                    <div class="col-sm-8 text-sm-left">
                                        <dd class="mb-1"><span
                                                class="label label-primary">{{ $item->status->name }}</span></dd>
                                    </div>
                                </dl>
                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right">
                                        <dt>Created by:</dt>
                                    </div>
                                    <div class="col-sm-8 text-sm-left">
                                        <dd class="mb-1">{{ $item->client->user->name }}</dd>
                                    </div>
                                </dl>
                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right">
                                        <dt>Messages:</dt>
                                    </div>
                                    <div class="col-sm-8 text-sm-left">
                                        <dd class="mb-1">{{ $item->comments()->count() }}</dd>
                                    </div>
                                </dl>
                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right">
                                        <dt>Client:</dt>
                                    </div>
                                    <div class="col-sm-8 text-sm-left">
                                        <dd class="mb-1">{{ $item->client->company_name }}</dd>
                                    </div>
                                </dl>


                            </div>
                            <div class="col-lg-6" id="cluster_info">

                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right">
                                        <dt>Last Updated:</dt>
                                    </div>
                                    <div class="col-sm-8 text-sm-left">
                                        <dd class="mb-1">{{ $item->updated_at->format('m-d-2020 H:s:i') }}</dd>
                                    </div>
                                </dl>
                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right">
                                        <dt>Created:</dt>
                                    </div>
                                    <div class="col-sm-8 text-sm-left">
                                        <dd class="mb-1"> {{ $item->created_at->format('m-d-2020 H:s:i') }}</dd>
                                    </div>
                                </dl>

                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right">
                                        <dt>Estimated hrs:</dt>
                                    </div>
                                    <div class="col-sm-8 text-sm-left">
                                        <dd class="mb-1"> {{ $item->estimated_time  }}</dd>
                                    </div>
                                </dl>

                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right">
                                        <dt>Hour Spent:</dt>
                                    </div>
                                    <div class="col-sm-8 text-sm-left">
                                        <dd class="mb-1"> {{ $item->hour_spent }}</dd>
                                    </div>
                                </dl>
                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right">
                                        <dt>Participants:</dt>
                                    </div>
                                    <div class="col-sm-8 text-sm-left">
                                        <dd class="project-people mb-1">
                                            Client: {{ $item->client->user->name }} <br>

                                            @if($item->cto_id)
                                                CTO: {{ $item->cto->name }} <br>
                                            @endif

                                            @if($item->dev_id)
                                                Dev: {{ $item->dev->name }} <br>
                                            @endif

                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <dl class="row mb-0">
                                    <div class="col-sm-2 text-sm-right">
                                        <dt>Completed:</dt>
                                    </div>
                                    <div class="col-sm-10 text-sm-left">
                                        <dd>
                                            <div class="progress m-b-1">
                                                <div style="width: {{ $item->status->order * 25 }}%;"
                                                     class="progress-bar progress-bar-striped progress-bar-animated"></div>
                                            </div>
                                            <small>Ticket completed in <strong>{{ $item->status->order * 25 }}%</strong>.
                                            </small>
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                        <div class="row m-t-sm">
                            <div class="col-lg-12">
                                <div class="panel blank-panel">
                                    <div class="panel-heading">
                                        <div class="panel-options">
                                            <ul class="nav nav-tabs">
                                                <li><a class="nav-link active" href="#tab-1" data-toggle="tab">Users
                                                        messages</a></li>
                                                <li><a class="nav-link" href="#tab-2" data-toggle="tab">Last
                                                        activity</a></li>
                                                <li><a class="nav-link" href="#tab-3" data-toggle="tab">Resume</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-1">
                                                <div class="feed-activity-list">

                                                    @if($item->comments()->count())

                                                        @foreach($item->comments as $comment)

                                                            <div class="feed-element">

                                                                <a href="#" class="float-left pr-5">
                                                                    {{ $comment->user->name }} <br>
                                                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                                </a>

                                                                <div class="media-body ">
                                                                    {!!  $comment->content  !!}
                                                                </div>

                                                            </div>

                                                        @endforeach

                                                        @else


                                                        <p>

                                                            No message has been registered yet
                                                        </p>

                                                    @endif

                                                </div>

                                                <div class="mt-5">


                                                    <form method="post" class="form-horizontal" id="" autocomplete="off"
                                                          action="{{ route('ticket_comments.store') }}">
                                                    {{ method_field('POST') }}
                                                    {{ csrf_field() }}

                                                    <!-- inicio dos campos -->

                                                        <div class="form-row">

                                                            <div class="form-group col-md-12 @if ($errors->has('content')) has-error @endif">
                                                                    <label for="content"><h3>Leave message</h3></label>
                                                                <textarea  rows="14" cols="50" name="content" id="content" class="froalaEditor form-control">{{ old('content') }}</textarea>
                                                                {!! $errors->first('content','<span class="help-block m-b-none">:message</span>') !!}
                                                            </div>

                                                            <input type="hidden" name="ticket_id" value="{{ $item->id }}">

                                                        </div>

                                                        <button class="btn btn-primary" id="" type="submit">
                                                            <i class="fa fa-save"></i>
                                                            Save message
                                                        </button>

                                                    <!-- FIM -->
                                                    </form>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="tab-2">

                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>User</th>
                                                        <th>Content</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @if($item->activities()->count())

                                                        @foreach($item->activities as $activity)

                                                            <tr>
                                                                <td>
                                                                    {{ $activity->user->name }}
                                                                </td>
                                                                <td>
                                                                    {!! $activity->activity  !!}
                                                                </td>
                                                                <td>
                                                                    {{ $activity->created_at->diffForHumans() }}
                                                                </td>


                                                            </tr>

                                                        @endforeach

                                                    @else


                                                        <p>

                                                            No message has been registered yet
                                                        </p>

                                                    @endif



                                                    </tbody>
                                                </table>

                                            </div>
                                            <div class="tab-pane" id="tab-3">

                                                <div class="col-lg-12">
                                                    <div class="ibox float-e-margins">

                                                        <div class="ibox-content">


                                                            <div class="form-row">
                                                                <div
                                                                    class="form-group col-md-12 @if ($errors->has('subject')) has-error @endif">
                                                                    <label for="subject">Subject</label>
                                                                    <p>{{$item->subject}}</p>
                                                                </div>

                                                                <div
                                                                    class="form-group col-md-12 @if ($errors->has('content')) has-error @endif">
                                                                    <label for="content">Content</label>
                                                                    <div>
                                                                        {!! $item->content !!}
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <div
                                                                    class="form-group col-md-3 @if ($errors->has('priority')) has-error @endif">
                                                                    <label for="priority">Priority</label>

                                                                    <p>
                                                                        {{$item->priority}}
                                                                    </p>


                                                                </div>
                                                            </div>

                                                            <div class="form-row">

                                                                <div
                                                                    class="form-group col-md-3 @if ($errors->has('file')) has-error @endif">
                                                                    <label for="image">Uploads</label>

                                                                    @if($item->files)

                                                                        <div class="form-row">
                                                                            <table
                                                                                class="table table-bordered table-striped">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>File</th>
                                                                                    <th>Created</th>
                                                                                    <th></th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody id="attachments">
                                                                                @foreach($item->files as $file)
                                                                                    <tr id="attachment_93">

                                                                                        <td class="text-center"
                                                                                            style="word-break: break-all;">
                                                                                            {{ $file->file }}
                                                                                        </td>
                                                                                        <td class="text-center">

                                                                                           {{ $file->created_at->format('m-d-Y H:s:i') }}


                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            <a target="_blank"
                                                                                               class="btn btn-sm btn-default"
                                                                                               href="{{ route('tickets.download', $file->id) }}">
                                                                                                <i class="fa fa-download"></i>
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                                </tbody>

                                                                            </table>

                                                                        </div>

                                                                    @endif

                                                                </div>

                                                            </div>




                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

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
    @include('panel._assets.scripts-froala')
@endsection
