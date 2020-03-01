<div class="form-row">

    <table class="table table-responsive w-100">
        <thead>
        <tr>
            <th width="5%">#</th>
            <th width="15%">From</th>
            <th width="65%">Data</th>
            <th width="15%">Action</th>
        </tr>
        </thead>
        <tbody>

        @if(isset($item->bank_accounts))

            @foreach($item->bank_accounts as $accounts)
                @php($i= $loop->index +1)
                <tr>
                    <td>{{ $i }}</td>
                    <td>
                        <div class="form-row ">
                            <div class="form-group col-md-12 ">
                                <label for="hangout">Country</label>
                                <input type="text" name="bank[{{ $i }}][name]" class="form-control"
                                       value="{{ $accounts->country }}" disabled>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($accounts->country == 'brazil')
                            <div class="form-row ">
                                <div class="form-group col-md-3 ">
                                    <label for="hangout">Bank Name</label>
                                    <input type="text" name="bank[{{ $i }}][name]" class="form-control"
                                           value="{{ $accounts->name }}" disabled>
                                </div>

                                <div class="form-group col-md-3 ">
                                    <label for="hangout">Bank Agency</label>
                                    <input type="text" name="bank[{{ $i }}][agency]"
                                           class="form-control"
                                           value="{{ $accounts->agency }}" disabled>
                                </div>

                                <div class="form-group col-md-3 ">
                                    <label for="hangout">Account Number</label>
                                    <input type="text" name="bank[{{ $i }}][number]" id=""
                                           class="form-control"
                                           value="{{ $accounts->number }}" disabled>
                                </div>

                                <div class="form-group col-md-3 ">
                                    <label for="hangout">CPF</label>
                                    <input type="text" name="bank[{{ $i }}][cpf]" id=""
                                           class="form-control mask_cpf"
                                           value="{{ $accounts->cpf }}" disabled>
                                </div>

                            </div>
                        @elseif($accounts->country == 'usa')
                            <div class="form-row ">

                                <div class="form-group col-md-4 ">
                                    <label for="hangout">Bank Name</label>
                                    <input type="text" name="bank[{{ $i }}][name]" class="form-control"
                                           value="{{ $accounts->name }}" disabled>
                                </div>

                                <div class="form-group col-md-4 ">
                                    <label for="hangout">Account Number</label>
                                    <input type="text" name="bank[{{ $i }}][number]" id=""
                                           class="form-control"
                                           value="{{ $accounts->number }}" disabled>
                                </div>

                                <div class="form-group col-md-4 ">
                                    <label for="hangout">Routing</label>
                                    <input type="text" name="bank[{{ $i }}][routing]" id=""
                                           class="form-control"
                                           value="{{ $accounts->routing }}" disabled>
                                </div>


                            </div>
                        @else
                            <div class="form-row ">

                                <div class="form-group col-md-4 ">
                                    <label for="hangout">Email</label>
                                    <input type="email" name="bank[{{ $i }}][email]" class="form-control"
                                           value="{{ $accounts->email }}" disabled>
                                </div>

                                <div class="form-group col-md-8 ">
                                    <label for="hangout">Description</label>
                                    <textarea disabled class="form-control" name="bank[{{ $i }}][description]" id=""
                                              cols="30" rows="3">{{ $accounts->description }}</textarea>
                                </div>

                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="form-group col-md-3 ">
                            <label for="hangout">Remove</label>
                            <input type="checkbox" name="bank[{{ $i }}][remove]"
                                   class="btn btn-default">
                        </div>


                    </td>

                    <input type="hidden" name="bank[{{ $i }}][id]" id=""
                           class="form-control "
                           value="{{ $accounts->id }}">


                </tr>

            @endforeach

        @endif


        @for($i=(isset($item->bank_accounts) ? $item->bank_accounts->count()+1 : 1 );$i<=(isset($item->bank_accounts) ? $item->bank_accounts->count()+2 : 2 );$i++)

            <tr>
                <td>{{ $i }}</td>
                <td>
                    <div class="form-row ">
                        <div class="form-group col-md-12 ">
                            <label for="hangout">Country</label>
                            <select name="bank[{{ $i }}][country]" id="country_{{$i}}"
                                    class=" country_select form-control">

                                <option
                                    value="brazil">
                                    Brazil
                                </option>
                                <option
                                    value="usa">
                                    USA
                                </option>
                                <option
                                    value="paypal">
                                    Paypal
                                </option>

                            </select>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-row div_bank_country_{{$i}} brazil" id="brazil_div_country_{{$i}}">

                        <div class="form-group col-md-3 ">
                            <label for="hangout">Bank Name</label>
                            <input type="text" name="bank[{{ $i }}][name]" class="form-control"
                                   value="">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="hangout">Bank Agency</label>
                            <input type="text" name="bank[{{ $i }}][agency]"
                                   class="form-control"
                                   value="">
                        </div>

                        <div class="form-group col-md-3 ">
                            <label for="hangout">Account Number</label>
                            <input type="text" name="bank[{{ $i }}][number]" id=""
                                   class="form-control"
                                   value="">
                        </div>

                        <div class="form-group col-md-3 ">
                            <label for="hangout">CPF</label>
                            <input type="text" name="bank[{{ $i }}][cpf]" id=""
                                   class="form-control mask_cpf"
                                   value="">
                        </div>

                    </div>

                    <div class="form-row div_bank_country_{{$i}} usa d-none" id="usa_div_country_{{$i}}">

                        <div class="form-group col-md-4 ">
                            <label for="hangout">Bank Name</label>
                            <input type="text" name="bank[{{ $i }}][name_usa]" class="form-control"
                                   value="">
                        </div>

                        <div class="form-group col-md-4 ">
                            <label for="hangout">Account Number</label>
                            <input type="text" name="bank[{{ $i }}][number_usa]" id=""
                                   class="form-control"
                                   value="">
                        </div>

                        <div class="form-group col-md-4 ">
                            <label for="hangout">Routing</label>
                            <input type="text" name="bank[{{ $i }}][routing]" id=""
                                   class="form-control"
                                   value="">
                        </div>

                    </div>

                    <div class="form-row div_bank_country_{{$i}} paypal  d-none" id="paypal_div_country_{{$i}}">

                        <div class="form-group col-md-4 ">
                            <label for="hangout">Email</label>
                            <input type="email" name="bank[{{ $i }}][email]" class="form-control"
                                   value="">
                        </div>

                        <div class="form-group col-md-8 ">
                            <label for="hangout">Description</label>
                            <textarea class="form-control" name="bank[{{ $i }}][description]" id="" cols="30"
                                      rows="3"></textarea>
                        </div>

                    </div>

                </td>
                <td>
                </td>

            </tr>

        @endfor

        </tbody>

    </table>

</div>

@section('scripts')

    @parent

    <script>
        $(function () {
            $(".country_select").on("change", function () {
                let id = $(this).attr('id')
                let val = $(this).val()
                let id_show = val + "_div_" + id

                $(".div_bank_" + id).addClass('d-none')
                $("#" + id_show).removeClass('d-none')

            })
        })
    </script>

@endsection
