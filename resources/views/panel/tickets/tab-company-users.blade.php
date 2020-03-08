
<div class="form-row">

    <div class="form-group col-md-12 ">
        {{--<label for="group_id">Select the Company to show the users</label>

        <select class="form-control form-control-lg"
                style="width: 100%"
                id="select_company">

            <option value="">Choose a company</option>

            @foreach(Auth::user()->clientUser as $clientUser)
                <option
                    value="{{ $clientUser->client_id }}">
                    {{ $clientUser->client->company_name }}
                </option>
            @endforeach
        </select>

        <br>--}}

        @php
            $userService = new \App\Services\UserService();
        @endphp

        @foreach(Auth::user()->clientUser as $clientUser)

            <div id="client_user_{{ $clientUser->client_id }}"
                 style="display: block;" class="div_company_users">

                <table class="table table-striped table-bordered table-hover">

                    <thead>
                    <tr>
                        <th>Users from {{ $clientUser->client->company_name }}</th>
                        <th width="20%">Type</th>
                    </tr>
                    <tbody>

                    @php
                        $users = $userService->listUsersOfCompany($clientUser->client_id);
                    @endphp

                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->isClientAdmin? 'Admim' : 'Regular User' }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
            <br>

        @endforeach

    </div>

</div>
