## Document

##### Để lấy 1 id apple random trong kho.
>/get-id-apple

##### Để log lại trường hợp không add được thông tin cho id apple
>/id-apple/fail/{idApple}

##### Để xóa toàn bộ dữ liệu của 1 id apple trong kho (nếu add fail quá nhiều lần)
>/id-apple/delete

##### Để lấy 1 credit card random trong kho.
>/get-credit

##### Để lấy 1 serial random trong kho.
>/get-serial

##### Để lưu lại id apple đã add thông tin thành công (id ngâm)
>/id-purchase/{user}/{device}/{idApple}/{serial}/{imei}/{lang}

`user: là username dùng đăng nhập trong admin`

`device: là id của thiết bị, 1 thiết bị chỉ gọi ra những id apple mà nó đã add`

