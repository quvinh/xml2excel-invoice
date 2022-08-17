<div style="float:right">
    <a href="https://oinvoice.vn"><img width="250px" src="https://oinvoice.vn/images/logoemail.png" alt="'.$option_titlepage.'"></a>
</div>
Xin chào {{$data['name']}}!<br><br>
Hệ thống {{$data['page']}} xin gửi bạn mã xác thực đăng nhập hệ thống:<br><br>
<b>Mã xác thực của bạn là:</b>
<font size="+2" color="#ff0000">{{$data['otp']}}</font><br><br>
<b>Lưu ý:</b> <i>Không chia sẻ mật khẩu này cho bất cứ ai, trong bất cứ trường hợp nào</i><br>
<b>Tạo lúc:</b> {{$data['time']}}<br><br>
Trân trọng!<br>
Nếu có bất kỳ thắc mắc nào xin liên hệ với chúng tôi qua hòm thư: {{$data['support']}}