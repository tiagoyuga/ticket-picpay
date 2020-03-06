Page {{ $data->currentPage()  }}/{{ $data->lastPage() }}. Showing
{{ $data->total() }}/{{ ($data->total() < $data->perPage()) ? $data->total() : $data->perPage() }} Messages.
<ul class="pagination pull-right">
    {{ $data->appends(Request::query())->links() }}
</ul>
