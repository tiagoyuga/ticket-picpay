<table class="table table-striped table-bordered table-hover">

    <thead>
    <tr>
        <th>Ticket #</th>
        <th>Client</th>
        <th>User</th>
        <th>Subject</th>
        <th>Status</th>
        <th>Priority</th>
        <th class="hidden-xs hidden-sm" style="width: 150px;">Created at</th>
        <th>Last Updated</th>
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
                <td><i class="{{ $item->priority }}">{{ $item->priority }}</i></td>
                <td class="hidden-xs hidden-sm">{{ $item->created_at->format('m-d-Y g:i A') }}</td>
                <td class="hidden-xs hidden-sm">{{ $item->updated_at->format('m-d-Y g:i A') }}</td>

                <td style="text-align: center">


                    <a class="btn btn-sm btn-default" title="Change status"
                       href="{{ route('tickets.changeStatus', [$item->id]) }}"><i
                            class="fa fa-list"></i>
                    </a>

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

