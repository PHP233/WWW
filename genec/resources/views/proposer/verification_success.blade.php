<!DOCTYPE html>
<html>
    <head>
        <title>验证成功</title>
    </head>
    <body>
    <p>恭喜您完成了认证，5秒后自动跳转到申报主页...</p>
    <p>如果没有跳转请点击下面的链接：</p>
    <a href="{{ route('proposer_index') }}">申请主页</a>
    </body>
    <script src="{{ asset('static/assets/js/jquery.min.js') }}"></script>
    <script>
        $(function () {
            setTimeout('load()',5000);
        });
        function load() {
            location.href = '{{ route('proposer_index') }}';
        }
    </script>
</html>