<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-checkable dataTable no-footer"
           id="data-apple">
        <thead>
        <tr>
            <th>
                <input type="checkbox" v-on:change="selectAll"/>
            </th>
            <th> Apple ID</th>
            <th> Password</th>
            <th> iPhone Internal Name</th>
            <th> iPhone Identify</th>
            <th> iPhone Model</th>
            <th> Total add infor fail</th>
            <th> Actions</th>
        </tr>
        </thead>
        <tbody>

        @if(!empty($idApples))
            @foreach($idApples as $i)

                <tr class="odd gradeX" role="row">
                    <td>
                        <input type="checkbox" class="checkboxIdApple" data-id="{{ $i->id }}"
                               v-on:change="selectIdApple"/>
                    </td>
                    <td>{{ $i->email }}</td>
                    <td>{{ $i->password }}</td>
                    <td>{{ $i->iphone_internal_name }}</td>
                    <td>{{ $i->iphone_identify }}</td>
                    <td>{{ $i->iphone_model }}</td>
                    <td>{{ $i->total_fail }}</td>
                    <td>
                        <form action="{{ route('apple.destroy', $i->id) }}" method="POST">
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

    @if(!empty($idApples))
        {{ $idApples->appends(['page_size' => $pageSize, 'fail' => $fail])->links() }}
    @endif
</div>