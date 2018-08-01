<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-checkable dataTable no-footer"
           id="data-idPurchases">
        <thead>
        <tr>
            <th>
                <input type="checkbox" v-on:change="selectAll"/>
            </th>
            <th> Apple ID</th>
            <th> Device</th>
            <th> Imei</th>
            <th> Language</th>
            <th> Total Purchase Successful</th>
            <th> Total Purchase Fail</th>
            <th> Money Purchased</th>
            <th> Actions</th>
        </tr>
        </thead>
        <tbody>

        @if(!empty($idPurchases))
            @foreach($idPurchases as $i)

                <tr class="odd gradeX" role="row">
                    <td>
                        <input type="checkbox" class="checkboxIdPurchase" data-id="{{ $i->id }}"
                               v-on:change="selectIdPurchase"/>
                    </td>
                    <td>{{ $i->apple->email }}</td>
                    <td>{{ $i->id_device }}</td>
                    <td>{{ $i->imei }}</td>
                    <td>{{ $i->language }}</td>
                    <td>{{ $i->total_purchase_successful }}</td>
                    <td>{{ $i->total_puchase_fail }}</td>
                    <td>{{ number_format($i->money_purchased) }}</td>
                    <td>
                        <form action="{{ route('idPurchase.destroy', $i->id) }}" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="button" class="btn red btn-xs" v-on:click="confirmDelete">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>

    @if(!empty($idPurchases))
        {{ $idPurchases->appends(['page_size' => $pageSize, 'fail' => $fail])->links() }}
    @endif
</div>