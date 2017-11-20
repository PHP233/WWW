<!DOCTYPE html>
<html>
<head>
    <title>修改密码成功</title>
</head>
<body>
<p>您已经修改了密码，5秒后自动跳转到登录页...</p>
<p>如果没有跳转请点击下面的链接：</p>
<a href="{{ route('proposer_login') }}">中国基因行业标准化技术委员会申报系统</a>
</body>
<script src="{{ asset('static/assets/js/jquery.min.js') }}"></script>
<script>
    $(function () {
        setTimeout('load()',5000);
    });
    function load() {
        location.href = '{{ route('proposer_login') }}';
    }
</script>
</html>