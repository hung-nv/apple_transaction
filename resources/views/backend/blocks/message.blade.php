@if(Session::has('success_message'))
    <div id="alert_container">
        <div class="alert alert-info">
            {{Session::get('success_message')}}
        </div>
    </div>
@elseif(Session::has('error_message'))
    <div id="alert_container">
        <div class="alert alert-warning">
            <strong>Warning!</strong> {{ Session::get('error_message') }}
        </div>
    </div>
@endif