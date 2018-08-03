@extends('backend.layouts.app')

@section('title')
    Administrator
@endsection

@section('content')
    <h3 class="page-title"> Administrator Dashboad</h3>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-share font-dark"></i>
                        <span class="caption-subject font-dark bold uppercase">Introduction</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                            <i class="icon-cloud-upload"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                            <i class="icon-wrench"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                            <i class="icon-trash"></i>
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h4 class="block">Để lấy 1 id apple random trong kho.</h4>
                    <code>/get-id-apple/{user}</code>

                    <h4 class="block">Để log lại trường hợp không add được thông tin cho id apple</h4>
                    <code>/id-apple/fail/{user}/{idApple}</code>

                    <h4 class="block"> Để xóa toàn bộ dữ liệu của 1 id apple trong kho (nếu add fail quá nhiều lần)</h4>
                    <code>/id-apple/delete/{user}/{idApple}</code>

                    <h4 class="block"> Để insert card vào kho.</h4>
                    <code>/add-credit/{user}/{number}</code>

                    <h4 class="block"> Để lấy 1 credit card random trong kho.</h4>
                    <code>/get-credit/{user}</code>

                    <h4 class="block"> Để ghi log lại add card thành công.</h4>
                    <code>/done-credit/{user}/{number}</code>

                    <h4 class="block"> Để ghi log lại add card thất bại.</h4>
                    <code>/fail-credit/{user}/{number}</code>

                    <h4 class="block"> Để lấy 1 serial random trong kho.</h4>
                    <code>/get-serial</code>

                    <h4 class="block"> Để lưu lại id apple đã add thông tin thành công (id ngâm)</h4>
                    <code>/id-purchase/{user}/{device}/{idApple}/{serial}/{imei}/{lang}</code>

                    <h4 class="block"> Để lấy ra id apple đã ngâm (lấy ra ngẫu nhiên 1 id apple đã ngâm được 3 ngày trở lên)</h4>
                    <code>/get-id-purchase/{user}/{device}</code>

                    <h4 class="block"> Để ghi log lại trường hợp nạp tiền thành công</h4>
                    <code>/done-purchase/{user}/{idApple}/{money}</code>

                    <h4 class="block"> Để ghi log lại trường hợp nạp tiền thất bại</h4>
                    <code>/fail-purchase/{user}/{idApple}</code>

                    <h4 class="block"> Để xóa id đã ngâm</h4>
                    <code>/delete-id-purchase/{user}/{idApple}</code>

                    <div class="note note-info margin-top-30">
                        <p>
                            user: là username dùng đăng nhập trong admin<br/>
                            device: là id của thiết bị, 1 thiết bị chỉ gọi ra những id apple mà nó đã add
                        </p>
                    </div>

                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>
@endsection