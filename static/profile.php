<?php
session_start();
require_once dirname(__DIR__).'/conn/conn.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$user_id = $_SESSION['user_id'];
$conn = get_conn();
$sql = "SELECT uName, email, head, regTime FROM tbl_user WHERE uId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($uName, $email, $head, $regTime);
$stmt->fetch();
$stmt->close();
$conn->close();
if (!$head) {
    $head = "1.gif";
}
?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>个人资料 - 诚信论坛</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/media.css">
    <style>
        .profile-container { margin: 40px auto 0; max-width: 480px; background: #fff; border-radius: 14px; box-shadow: 0 4px 24px rgba(0,0,0,0.10); padding: 38px 42px 32px 42px; position: relative; }
        .avatar { width: 110px; height: 110px; border-radius: 50%; object-fit: cover; display: block; margin: -70px auto 20px auto; border: 4px solid #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.07); background: #f1f1f1; }
        .profile-info-table { width:92%; border-collapse:separate; border-spacing:0 12px; margin: 0 auto 18px auto; }
        .profile-info-table td.label { width: 95px; color: #4f6070; padding: 10px 0; text-align: right; font-weight: bold; font-size: 16px; letter-spacing: 1px; background: none; }
        .profile-info-table td.value { color: #222; padding: 10px 0 10px 22px; text-align: left; font-size: 17px; background: #f7f7fa; border-radius: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.03); border: 1px solid #e0e3ea; }
        .bio { background: #f6faff; border-radius: 8px; padding: 16px; margin-top: 26px; color: #4b5a6a; font-size: 15px; box-shadow: 0 1px 3px rgba(0,0,0,0.03); border: 1px solid #e0e3ea; }
        @media (max-width:600px) {
            .profile-container { padding: 20px 4vw 16px 4vw; }
            .profile-info-table td.label, .profile-info-table td.value { font-size: 15px; }
        }
    </style>
</head>
<body>
<div class="container">
    <!-- 左侧信息栏 -->
    <div class="sidebar">
        <img src="../image/logo.png" alt="logo" class="logo">
        <h4>欢迎来到诚信论坛,这是一个带来希望和光明的地方</h4>
        <div class="sidebar-actions">
            <?php if (isset($_SESSION['uname'])): ?>
                <img class="sidebar-user-avatar" src="<?php echo $head ? '../image/head/' . htmlspecialchars($head) : '../image/head/1.gif'; ?>" alt="头像">
                <span class="sidebar-user"><?php echo htmlspecialchars($_SESSION['uname']); ?></span>
                <a href="logout.php" class="sidebar-btn">退出登录</a>
                <a href="profile.php" class="sidebar-btn sidebar-btn-active">个人资料</a>
            <?php else: ?>
                <a href="reg.php" class="sidebar-btn">注册</a>
                <a href="login.php" class="sidebar-btn">登录</a>
            <?php endif; ?>
        </div>
    </div>
    <!-- 右侧内容栏 -->
    <div class="main">
        <div class="profile-container">
            <img src="<?php echo $head ? '../image/head/' . htmlspecialchars($head) : '../image/head/1.gif'; ?>" alt="头像" class="avatar">
            <div class="info">
                <table class="profile-info-table">
                    <tr>
                        <td class="label">用户名：</td>
                        <td class="value"><?php echo htmlspecialchars($uName); ?></td>
                    </tr>
                    <tr>
                        <td class="label">邮箱：</td>
                        <td class="value"><?php echo htmlspecialchars($email); ?></td>
                    </tr>
                    <tr>
                        <td class="label">注册时间：</td>
                        <td class="value"><?php echo htmlspecialchars($regTime); ?></td>
                    </tr>
                </table>
            </div>
            <div class="bio">
                <strong>个人简介：</strong><br>
                <span style="color:#b5bfcf;font-size:14px;">（暂未填写）</span>
            </div>
<!--            <a href="edit_profile.php" class="edit-btn">编辑资料</a>-->
        </div>
    </div>
</div>
</body>
</html>
