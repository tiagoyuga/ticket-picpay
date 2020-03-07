@extends('panel._layouts.panel')

@section('_titulo_pagina_', (isset($item) ? 'Edit' : 'Create') . ' '.$label)

@section('content')

    @include('panel.tickets.nav')

    @php
        $visibility = [];
        $visibility['all'] = true;
        $visibility['client'] = false;
        $visibility['cto'] = false;
        $visibility['dev'] = false;
        $visibility['admin'] = false;
        $visibility['members'] = false;
    @endphp

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="m-b-md">
                                    @can('update', $item)
                                        <a href="{{ route('tickets.edit', $item->id) }}"
                                           class="btn btn-white btn-xs float-right">Edit ticket</a>
                                    @endcan
                                    <h2>{{ $item->subject }}</h2>
                                    <span>{{ $item->uid }}</span>
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
                                        <dd class="mb-1">{{ $item->userClient->name }}</dd>
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

                                @if(!\Auth::user()->is_client)

                                    <dl class="row mb-0">
                                        <div class="col-sm-4 text-sm-right">
                                            <dt>Est Dev. hrs:</dt>
                                        </div>
                                        <div class="col-sm-8 text-sm-left">
                                            <dd class="mb-1">{{ $item->dev_estimated_time }}</dd>
                                        </div>
                                    </dl>

                                    <dl class="row mb-0">
                                        <div class="col-sm-4 text-sm-right">
                                            <dt>CTO Hrs:</dt>
                                        </div>
                                        <div class="col-sm-8 text-sm-left">
                                            <dd class="mb-1">{{ $item->cto_hours  }}</dd>
                                        </div>
                                    </dl>

                                @endif


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
                                            Client: {{ $item->userClient->name }} <br>

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
                                                <li><a class="nav-link active" href="#tab-1" data-toggle="tab">Message
                                                        Center</a></li>
                                                <li><a class="nav-link" href="#tab-2" data-toggle="tab">Last
                                                        activity</a></li>
                                                <li><a class="nav-link" href="#tab-3" data-toggle="tab">Summary</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-1">
                                                <div class="feed-activity-list">

                                                    @php
                                                        $user = \Auth::user();
                                                    @endphp

                                                    @if($item->comments()->count())

                                                        @php

                                                            switch ($user->group_id){

                                                                 case (\App\Models\Group::CLIENT):
                                                                     $visibility['client'] = true;
                                                                     break;
                                                                 case (\App\Models\Group::CTO):
                                                                     $visibility['cto'] = true;
                                                                     $visibility['members'] = true;
                                                                     break;
                                                                 case (\App\Models\Group::DEVELOPER):
                                                                     $visibility['dev'] = true;
                                                                     $visibility['members'] = true;
                                                                     break;
                                                                 case (\App\Models\Group::ADMIN):
                                                                     $visibility['admin'] = true;
                                                                     $visibility['members'] = true;
                                                                     break;

                                                             }


                                                        @endphp

                                                        @foreach($item->comments as $comment)

                                                            @if($user->is_admin || $comment->user_id == \Auth::id() || $visibility[$comment->to_users] === true )

                                                                <div class="feed-element">

                                                                    <a href="#" class="float-left pr-5">
                                                                        {{ $comment->user->name }} <br>
                                                                        <i class="text-muted">to: {{ $comment->to_users }}</i>
                                                                        <br>
                                                                        <small
                                                                            class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                                    </a>

                                                                    <div class="media-body ">
                                                                        {!!  $comment->content  !!}
                                                                    </div>

                                                                </div>

                                                            @endif

                                                        @endforeach

                                                    @else


                                                        <p>

                                                            No message has been registered yet
                                                        </p>

                                                    @endif

                                                </div>

                                                <div class="mt-5">


                                                    <form method="post" class="form-horizontal"
                                                          enctype="multipart/form-data"
                                                          id="" autocomplete="off"
                                                          action="{{ route('ticket_comments.store') }}">
                                                    {{ method_field('POST') }}
                                                    {{ csrf_field() }}

                                                    <!-- inicio dos campos -->

                                                        <div class="form-row">

                                                            <div
                                                                class="form-group col-md-3 @if ($errors->has('file')) has-error @endif">


                                                                <label for="content"><h3>Send
                                                                        to </h3></label>

                                                                <select class="select2 form-control form-control-lg"
                                                                        style="width: 100%"
                                                                        name="to_users"
                                                                        id="to_users"
                                                                        required>

                                                                    <option value="">Select</option>

                                                                    @if($user->isClient)
                                                                        <option value="all">All</option>
                                                                        <option value="admin">Admin</option>
                                                                        <option value="cto">Cto</option>
{{--                                                                        <option value="dev">Dev</option>--}}
                                                                    @else

                                                                        @cannot('userCanChat', $item->client)
                                                                            <option value="members">All Members</option>
                                                                            <option value="admin">Admin</option>
                                                                            <option value="cto">Cto</option>
                                                                            <option value="dev">Dev</option>
                                                                        @endcannot

                                                                        @can('userCanChat', $item->client)
                                                                            <option value="all">All</option>

                                                                            @if($visibility['client'] == false)
                                                                                <option value="members">Members</option>
                                                                                <option value="client">Client</option>
                                                                            @endif

                                                                            <option value="admin">Admin</option>
                                                                            <option value="cto">Cto</option>
                                                                            <option value="dev">Dev</option>
                                                                        @endcan

                                                                    @endif


                                                                </select>

                                                                {!! $errors->first('to_users','<span class="help-block m-b-none">:message</span>') !!}

                                                            </div>

                                                        </div>

                                                        <div class="form-row">

                                                            <div
                                                                class="form-group col-md-12 @if ($errors->has('content')) has-error @endif">
                                                                <label for="content"><h3>Message</h3></label>
                                                                <textarea rows="14" cols="50" name="content"
                                                                          id="content"
                                                                          class="froalaEditor form-control"
                                                                          placeholder="Write your message here"
                                                                >{{ old('content') }}</textarea>
                                                                {!! $errors->first('content','<span class="help-block m-b-none">:message</span>') !!}
                                                            </div>

                                                            <input type="hidden" name="ticket_id"
                                                                   value="{{ $item->id }}">

                                                        </div>


                                                        <div class="form-row">

                                                            <div
                                                                class="form-group col-md-3 @if ($errors->has('file')) has-error @endif">
                                                                <label for="image">Upload File</label>
                                                                <input id="file" name="file" type="file"
                                                                       class="form-control required"
                                                                       accept="image/gif, image/jpeg, image/png, application/pdf"
                                                                >
                                                            </div>

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


                                                            @if($user->isAdmin || $user->id == $activity->user_id ||
                                                                     $item->client->usersTypeUser->contains($user->id))

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

                                                            @endif

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
                                                                    <label
                                                                        for="subject"><strong>Subject</strong></label>
                                                                    <p>{{$item->subject}}</p>
                                                                </div>
                                                            </div>
                                                            <hr>

                                                            <div class="form-row">
                                                                <div
                                                                    class="form-group col-md-12 @if ($errors->has('content')) has-error @endif">
                                                                    <label
                                                                        for="content"><strong>Content</strong></label>
                                                                    <div>
                                                                        {!! $item->content !!}
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="form-row">
                                                                <div
                                                                    class="form-group col-md-3 @if ($errors->has('priority')) has-error @endif">
                                                                    <label
                                                                        for="priority"><strong>Priority</strong></label>

                                                                    <p>
                                                                        <span
                                                                            class="{{$item->priority}} {{$item->priority == 'medium' ? 'text-warning' : ''}}">{{$item->priority}}</span>
                                                                    </p>

                                                                </div>

                                                            </div>

                                                            <hr>

                                                            <div class="form-row">

                                                                <div
                                                                    class="form-group col-md-12 @if ($errors->has('file')) has-error @endif">
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
    @include('panel._assets.scripts-ckeditor')

    <script>

        setCkeditor('content');

    </script>
@endsection
