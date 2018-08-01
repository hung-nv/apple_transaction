<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-checkable dataTable no-footer">
        <thead>
        <tr>
            <th> ID</th>
            <th> Apple ID</th>
            <th> Device</th>
            <th> Language</th>
            <th> Money Purchased</th>
            <th> Time Purchased</th>
            <th> Status</th>
        </tr>
        </thead>
        <tbody>

        @if(!empty($transaction))
            @foreach($transaction as $i)

                <tr class="odd gradeX" role="row">
                    <td>{{ $i->id }}</td>
                    <td>{{ $i->idPurchase->apple->email }}</td>
                    <td>{{ $i->idPurchase->id_device }}</td>
                    <td>{{ $i->idPurchase->language }}</td>
                    <td>{{ number_format($i->money) }}</td>
                    <td>{{ $i->created_at }}</td>
                    <td class="data-middle">
                        @if($i->money != 0)
                            <span class="badge badge-primary badge-roundless"> Done </span>
                        @else
                            <span class="badge badge-danger badge-roundless"> Fail </span>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>

    @if(!empty($transaction))
        {{ $transaction->appends(['page_size' => $pageSize, 'email' => $email])->links() }}
    @endif
</div>