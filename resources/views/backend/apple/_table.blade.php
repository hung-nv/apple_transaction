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
            <th> Used</th>
            <th> Actions</th>
        </tr>
        </thead>
        <tbody>

        @if(!empty($data))
            @foreach($data as $i)

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
                        @if($i->is_used === 0)
                            <span class="badge badge-info badge-roundless"> No </span>
                        @else
                            <span class="badge badge-default badge-roundless"> Yes </span>
                        @endif
                    </td>
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

    {{ $data->appends(['sort' => 'votes'])->links() }}
</div>