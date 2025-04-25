<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录 - 太阳论坛</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/media.css">
</head>
<body>
<div class="login-container">
    <form class="login-box" method="post" action="#" name="loginForm">
        <h2>用户登录</h2>
        <label for="username">用户名</label>
        <input type="text" id="username" name="uName" required autocomplete="username">
        <label for="password">密码</label>
        <input type="password" id="password" name="uPass" required autocomplete="current-password">
        <button type="submit" class="login-btn">登录</button>
        <div class="login-links">
            <a href="index.php">返回首页</a>
            <a href="reg.php">去注册</a>
        </div>
    </form>
    <?php

    ?>
</div>
</body>
</html>