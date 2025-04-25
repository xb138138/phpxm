<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>帖子详情 - 太阳论坛</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/media.css">
    <style>

    </style>
</head>
<body>
<div class="container">
    <!-- 左侧信息栏 -->
    <div class="sidebar">
        <img src="../image/logo.png" alt="logo">
        <h4>欢迎来到太阳论坛,这是一个带来希望和光明的地方</h4>
        <div class="sidebar-actions">
            <a href="reg.php" class="sidebar-btn">注册</a>
            <a href="login.php" class="sidebar-btn">登录</a>
        </div>
    </div>
    <!-- 右侧内容栏 -->
    <div class="main">
        <a href="index.php" class="back-btn" onclick="if(history.length>1){history.back();return false;}">←</a>
        <div class="detail-header">
            <h2>【分享】我的学习心得</h2>
            <div class="detail-meta">
                <span>作者：小明</span> |
                <span>发布时间：2025-04-25 20:00</span>
            </div>
        </div>
        <div class="detail-content">
            <p>最近在学习前端开发，收获很大，欢迎交流！如果你有好的学习方法，也可以一起分享。</p>
        </div>
        <hr>
        <div class="reply-section">
            <h4>全部回复</h4>
            <div class="reply-list">
                <div class="reply-item">
                    <div class="reply-meta"><strong>用户A</strong> | 2025-04-25 21:00</div>
                    <div class="reply-content">谢谢分享，受益匪浅！</div>
                </div>
                <div class="reply-item">
                    <div class="reply-meta"><strong>用户B</strong> | 2025-04-25 21:30</div>
                    <div class="reply-content">我也在学前端，可以交流一下~</div>
                </div>
                <div class="reply-item">
                    <div class="reply-meta"><strong>用户B</strong> | 2025-04-25 21:30</div>
                    <div class="reply-content">我也在学前端，可以交流一下~</div>
                </div>
                <div class="reply-item">
                    <div class="reply-meta"><strong>用户B</strong> | 2025-04-25 21:30</div>
                    <div class="reply-content">我也在学前端，可以交流一下~</div>
                </div>
            </div>
            <div class="reply-form">
                <h5>发表回复</h5>
                <form action="#" method="post">
                    <label>
                        <textarea name="reply_content" rows="4" placeholder="说点什么吧..."></textarea>
                    </label>
                    <br>
                    <button type="submit" class="sidebar-btn">回复</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
