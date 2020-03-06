<div class="m-b-lg">

    <form method="get" id="frm_search" action="{{ route('tickets.index') }}">

        <div class="row">

            <div class="form-group col-md-5">
                <label for="search">Search</label>
                <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}"
                       placeholder="{{ isset($_placeholder_) ? $_placeholder_ : 'Type something to perform your search' }}">
            </div>

            <div class="col-sm-5">

                <div class="form-group">

                    <label class="control-label">From</label>

                    <div class="input-group date_calendar">

                        <input type="text" class="form-control mask_date_usa datepicker_usa"
                               name="start_date"
                               id="start_date"
                               {{--value="{{ request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->format('Y-m-d') : '' }}"--}}
                            value="{{ request('start_date') }}"

                        >

                        <span class="input-group-addon">to</span>

                        <input type="text" class="form-control mask_date_usa datepicker_usa"
                               name="end_date"
                               id="end_date" value="{{ request('end_date') }}"
                               placeholder="____/__/__"
                        >
                    </div>

                </div>

            </div>

            <div class="form-group col-sm-2 text-right">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-primary form-control" id="btn_search">
                    <i class="fa fa-search"></i> Pesquisar
                </button>
            </div>

        </div>

    </form>
</div>

@section('scripts')
    @include('panel._assets.scripts-datepicker')

    <script>
        @if(request('start_date'))
            $("#start_date").val('{{ request('start_date') }}');
            @endif
    </script>
@endsection
