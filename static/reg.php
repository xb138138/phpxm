<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注册 - 太阳论坛</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/media.css">
</head>
<body>
<div class="reg-container">
    <form class="reg-box" method="post" action="#" name="regForm">
        <h2>用户注册</h2>
        <label for="username">用户名</label>
        <input type="text" id="username" name="uName" required autocomplete="username">
        <label for="password">密码</label>
        <input type="password" id="password" name="uPass" required autocomplete="new-password">
        <label for="repassword">确认密码</label>
        <input type="password" id="repassword" name="rePass" required autocomplete="new-password">
        <button type="submit" class="reg-btn">注册</button>
        <div class="reg-links">
            <a href="index.php">返回首页</a>
            <a href="login.php">去登录</a>
        </div>
    </form>
</div>
<script>
    function checkPasswordMatch(e) {
        const {value: pwd} = document.getElementById('password');
        const {value: repwd} = document.getElementById('repassword');
        if (pwd !== repwd) {
            alert('两次输入的密码不一致！');
            e.preventDefault();
            return false;
        }
        return true;
    }
    window.onload = function() {
        const form = document.forms['regForm'];
        if(form) {
            form.onsubmit = checkPasswordMatch;
        }
    }
</script>
</body>
</html>
