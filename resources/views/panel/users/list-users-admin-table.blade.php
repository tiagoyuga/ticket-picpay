<div class="table-responsive">

    @if($data->count())

        <table class="table table-striped table-bordered table-hover">

            <thead>
            <tr>
                <th>Name</th>
                <th>E-mail</th>
                <th>Group</th>
                <th>Privileges setup</th>
                <th class="hidden-xs hidden-sm" style="width: 150px;">Created at</th>
                <th style="width: 290px; text-align: center">Actions</th>
            </tr>
            </thead>
            <tbody>

            @if($data->count())
                @foreach($data as $item)
                    <tr id="tr-{{ $item->id }}">

                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ isset($item->group_id) ? $item->group->name : ''}}</td>
                        <td style="width: 20%">

                            @if($item->group_id == \App\Models\Group::CLIENT)

                                @foreach($item->clients as $client)

                                    @php
                                        $client_user = \App\Models\ClientUser::where('client_id', $client->id )
                                        ->where('user_id', $item->id )->first();
                                    @endphp

                                    <br>
                                    <div class="w-100 mb-1">

                                        <span>{{ $client->company_name }}</span><br><br>
                                        <button id="btn_admin_{{ $client_user->id }}"
                                                type="button"
                                                class="btn btn-{{ $client_user->is_admin ? 'primary' : 'default'}}"
                                                onclick="changePrivilegies('{{ $item->id }}', '{{ $client->id }}', '{{$client_user->id}}' );"
                                        >Admin
                                        </button>

                                        <button id="btn_regular_{{ $client_user->id }}"
                                                type="button"
                                                class="btn btn-{{ !$client_user->is_admin ? 'primary' : 'default'}}"
                                                onclick="changePrivilegies('{{ $item->id }}', '{{ $client->id }}', '{{$client_user->id}}' );"
                                        >Regular user
                                        </button>
                                    </div>
                                    <hr>
                                @endforeach

                            @else
                                -/-
                            @endif
                        </td>

                        <td class="hidden-xs hidden-sm">{{ $item->created_at->format('m-d-Y g:i A') }}</td>

                        <td style="text-align: center">

                            <a class="btn btn-sm btn-default" title="Edit"
                               href="{{ route('users.edit', [$item->id]) }}"><i
                                    class="fa fa-pencil"></i>
                            </a>

                            <link-destroy-component
                                line-id="{{ 'tr-'.$item->id }}"
                                link="{{ route('users.destroy', [$item->id]) }}">
                            </link-destroy-component>

                        </td>

                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

        @include('panel._assets.paginate')

    @else
        <div class="alert alert-danger">
            We have nothing to display. If you have performed a search, you can perform
            a new one with other terms or <a class="alert-link"
                                             href="{{ route('users.index') }}">
                clear your search.
            </a>
        </div>
    @endif
</div>
