<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-checkable dataTable no-footer"
           id="data-idPurchases">
        <thead>
        <tr>
            <th>
                <input type="checkbox"/>
            </th>
            <th> Apple ID</th>
            <th> Device</th>
            <th> Imei</th>
            <th> Language</th>
            <th> Actions</th>
        </tr>
        </thead>
        <tbody>

        @if(!empty($idPurchases))
            @foreach($idPurchases as $i)

                <tr class="odd gradeX" role="row">
                    <td>
                        <input type="checkbox" class="checkboxIdApple" data-id="{{ $i->id }}"/>
                    </td>
                    <td>{{ $i->apple->email }}</td>
                    <td>{{ $i->id_device }}</td>
                    <td>{{ $i->imei }}</td>
                    <td>{{ $i->language }}</td>
                    <td>
                        <form action="{{ route('idPurchase.destroy', $i->id) }}" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="button" class="btn red btn-xs">
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
        {{ $idPurchases->links() }}
    @endif
</div>