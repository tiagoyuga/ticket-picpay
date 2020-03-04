Page {{ $data->currentPage()  }}/{{ $data->lastPage() }}. Showing
{{ $data->perPage() }}/{{ $data->total() }} Messages.
<ul class="pagination pull-right">
    {{ $data->appends(Request::query())->links() }}
</ul>
