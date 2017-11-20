<!DOCTYPE html>
<html>
<head>
    <title>重置密码成功</title>
</head>
<body>
<p>您已经重置了密码，5秒后自动跳转到登录页...</p>
<p>如果没有跳转请点击下面的链接：</p>
<a href="{{ route('reviewer_login') }}">中国基因行业标准化技术委员会</a>
</body>
<script src="{{ asset('static/assets/js/jquery.min.js') }}"></script>
<script>
    $(function () {
        setTimeout('load()',5000);
    });
    function load() {
        location.href = '{{ route('reviewer_login') }}';
    }
</script>
</html>