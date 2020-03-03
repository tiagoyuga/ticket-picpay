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

                    <label class="control-label">Created between dates</label>

                    <div class="input-group date_calendar">

                        <input type="text" class="form-control mask_date datepicker"
                               name="start_date"
                               id="start_date" value="{{ request('start_date') }}">

                        <span class="input-group-addon">and</span>

                        <input type="text" class="form-control mask_date datepicker"
                               name="end_date"
                               id="end_date" value="{{ request('end_date') }}">
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
@endsection
