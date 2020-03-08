<div class="table-responsive">

    <a target="_blank" class="btn btn-primary mb-3 pull-right" id="ln_adicionar" title="add users to client"
       href="{{ route('public_users.new', base64_encode($client_id)) }} ">
        <i class="fa fa-plus-circle"></i> Add new user to {{ $client_name }}
    </a>

    @if($data->count())

        <table class="table table-striped table-bordered table-hover">

            <thead>
            <tr>
                <th>Name</th>
                <th>E-mail</th>
                <th>Privileges setup</th>
                <th class="hidden-xs hidden-sm" style="width: 150px;">Created at</th>

            </tr>
            </thead>
            <tbody>

            @if($data->count())

                @foreach($data as $item)

                    <tr id="tr-{{ $item->id }}">

                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td style="width: 20%">

                            @if($item->group_id == \App\Models\Group::CLIENT)

                                @php
                                    $client_user = \App\Models\ClientUser::where('client_id', $client_id )
                                    ->where('user_id', $item->id )->first();
                                @endphp

                                <br>
                                <div class="w-100 mb-1">

                                    <button id="btn_admin_{{ $client_user->id }}"
                                            type="button"
                                            class="btn btn-{{ $client_user->is_admin ? 'primary' : 'default'}}"
                                            onclick="changePrivilegies('{{ $item->id }}', '{{ $client_id }}', '{{$client_user->id}}' );"
                                    >Admin
                                    </button>

                                    <button id="btn_regular_{{ $client_user->id }}"
                                            type="button"
                                            class="btn btn-{{ !$client_user->is_admin ? 'primary' : 'default'}}"
                                            onclick="changePrivilegies('{{ $item->id }}', '{{ $client_id }}', '{{$client_user->id}}' );"
                                    >Regular user
                                    </button>
                                </div>


                            @else
                                -/-
                            @endif
                        </td>

                        <td class="hidden-xs hidden-sm">{{ isset($item->created_at) ?
        $item->created_at->format('m-d-Y g:i A') : '' }}</td>


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
