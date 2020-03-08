@php
    $is_client = \Auth::user()->group_id == \App\Models\Group::CLIENT;
    $isClientAdmim = \Auth::user()->isClientAdmin;
@endphp

<table class="table table-striped table-bordered table-hover">

    <thead>
    <tr>
        <th>Ticket #</th>
        <th>Client</th>
        <th>User</th>
        <th>Subject</th>
        <th>Status</th>
        <th>Priority</th>

        @if (isset($isAdmim) && $isAdmim)
            <th>Est. Hrs</th>
            <th>Hrs Spent</th>

        @endif

        <th>Last Updated</th>

        {{--@if($is_client)
            <th>Est. Hrs</th>
            <th>Hrs Spent</th>
        @endif--}}

        @if($isClientAdmim)
            <th>Est. Hrs</th>
            <th>Hrs Spent</th>
            <th>Payment Status</th>
            {{--<th>Dev Hrs</th>--}}
        @endif

        <th style="width: 100px; text-align: center">Actions</th>
    </tr>
    </thead>
    <tbody>

    @if($data->count())

        @foreach($data as $item)

            <tr id="tr-{{ $item->id }}">

                <td>{{ $item->uid }}</td>
                <td>{{ $item->client->company_name }}</td>
                <td>{{ $item->userClient->name }}</td>
                <td>{{ $item->subject }}</td>
                <td>{{  $item->status->name }}</td>
                <td>
                    <i class="{{ $item->priority }} {{ $item->priority == 'medium' ? 'text-warning' : '' }}">{{ $item->priority }}</i>
                </td>

                @if (isset($isAdmim) && $isAdmim)
                    <td>{{$item->est_hrs_client}}</td>
                    <td>{{$item->dev_hrs_client }}</td>
                @endif

                <td class="hidden-xs hidden-sm">{{ $item->updated_at->format('m-d-Y g:i A') }}</td>

                {{--@if($is_client)
                    <td>{{$item->est_hrs_client}}</td>
                    <td>{{$item->dev_hrs_client }}</td>
                @endif--}}

                @if($isClientAdmim)

                    <td>{{$item->est_hrs_client}}</td>
                    <td>{{$item->dev_hrs_client }}</td>

                    <td>
                        <span class="{{ strtolower($item->payment_status) == 'paid' ? 'alert-success' : 'alert-danger' }}">
                            {{ $item->payment_status }}
                        </span>

                        @if(strtolower($item->payment_status) == 'paid')
                            <br>
                            <span>Paid at: {{ $item->payment_date->format('m-d-y') }}</span>
                        @endif
                    </td>

                    {{--<td>{{$item->dev_hrs_client }}</td>--}}
                @endif

                <td style="text-align: center">

                    @php
                        $is_admin_from_client = \App\Models\ClientUser::isClientInThisCompany($item->client_id)->first();
                    @endphp


                    @if($is_client && isset($is_admin_from_client) && ($is_admin_from_client->is_admin))

                        <a class="btn btn-sm btn-default" title="{{ $item->flag ? 'Unflag':'Flag' }}"
                           href="{{ route('tickets.flag', [$item->id]) }}"><i
                                class="fa fa-flag {{ $item->flag ? 'text-danger':'text-success' }}"></i>
                        </a>

                    @endif

                    @can('update', $item)
                        <a class="btn btn-sm btn-default" title="Edit ticket"
                           href="{{ route('tickets.edit', [$item->id]) }}"><i
                                class="fa fa-pencil"></i>
                        </a>
                    @endif

                    @can('changeStatus', $item)
                        <a class="btn btn-sm btn-default" title="Change status"
                           href="{{ route('tickets.changeStatus', [$item->id]) }}"><i
                                class="fa fa-list"></i>
                        </a>
                    @endif

                    <a class="btn btn-sm btn-default" title="Ticket Center"
                       href="{{ route('tickets.detail', [$item->id]) }}"><i
                            class="fa fa-history"></i>
                    </a>




                </td>

            </tr>
        @endforeach
    @endif
    </tbody>
</table>

