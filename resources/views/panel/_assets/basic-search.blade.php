<div class="row">
    <div class="form-group col-md-10">
        <label for="search">Search</label>
        <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}"
               placeholder="{{ isset($_placeholder_) ? $_placeholder_ : 'Type something to perform your search' }}">
    </div>
    <div class="form-group col-sm-2 text-right">
        <label>&nbsp;</label>
        <button type="submit" class="btn btn-primary form-control" id="btn_search">
            <i class="fa fa-search"></i> Search
        </button>
    </div>
</div>
