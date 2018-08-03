<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-checkable dataTable no-footer">
        <thead>
        <tr>
            <th> Date</th>
            <th> Money</th>
        </tr>
        </thead>
        <tbody>

        @if(!empty($statistic))
            @foreach($statistic as $i)

                <tr class="odd gradeX" role="row">
                    <td>{{ $i->date }}</td>
                    <td>{{ number_format($i->money) }}</td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>

    @if(!empty($statistic))
        {{ $statistic->links() }}
    @endif
</div>