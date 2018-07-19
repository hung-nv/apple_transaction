@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button class="close" data-close="alert"></button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif