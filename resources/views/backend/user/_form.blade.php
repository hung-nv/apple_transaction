<div class="form-body">

    <div class="form-group">
        <label class="control-label col-md-3">Username</label>
        <div class="col-md-4">
            <input type="text" name="username" id="username" class="form-control"
                   placeholder="Enter your yourname" value="{{ $data['username'] or old('username') }}" required/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Name</label>
        <div class="col-md-4">
            <input name="name" id="name" type="text" class="form-control"
                   placeholder="Enter your name" value="{{ $data['name'] or old('name') }}" required></div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3">Password</label>
        <div class="col-md-4">
            <input type="password" name="password" id="password" class="form-control"
                   placeholder="Enter your password"></div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3">Password confirm</label>
        <div class="col-md-4">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                   placeholder="Retype Password"></div>
    </div>

    <?php $role = isset($data) ? $data['role'] : old('role'); ?>
    <div class="form-group">
        <label class="control-label col-md-3">Role</label>
        <div class="col-md-4">
            <select class="form-control" name="role">
                <option value="2" @if($role == 2) selected @endif>Member</option>
                <option value="1" @if($role == 1) selected @endif>Administrator</option>
            </select>
        </div>
    </div>
</div>