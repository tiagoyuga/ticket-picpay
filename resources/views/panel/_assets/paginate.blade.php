Page {{ $data->currentPage()  }} of {{ $data->lastPage() }}. Showing
of {{ $data->firstItem() }} to {{ $data->lastItem() }}
of a total in {{ $data->total() }} items.
<ul class="pagination pull-right">
    {{ $data->appends(Request::query())->links() }}
</ul>
