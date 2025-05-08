<?php
session_start();
require_once dirname(__DIR__) . '/model/conn.php';
$user_head = '';
if (isset($_SESSION['uname'])) {
    $conn = get_conn();
    $stmt = $conn->prepare("SELECT head FROM tbl_user WHERE uName=? LIMIT 1");
    $stmt->bind_param("s", $_SESSION['uname']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $user_head = $row['head'];
    }
    $stmt->close();
    $conn->close();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>太阳论坛</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/media.css">
</head>
<body>
    <div class="container main-content">
        <!-- 左侧信息栏 -->
        <div class="sidebar">
            <img src="../image/logo.png" alt="logo" class="logo">
            <h4>欢迎来到太阳论坛,这是一个带来希望和光明的地方</h4>
            <div class="sidebar-actions">
                <?php if (isset($_SESSION['uname'])): ?>
                    <img class="sidebar-user-avatar" src="<?php echo $user_head ? '../image/head/' . htmlspecialchars($user_head) : '../image/head/1.gif'; ?>" alt="头像">
                    <span class="sidebar-user"><?php echo htmlspecialchars($_SESSION['uname']); ?></span>
                    <a href="logout.php" class="sidebar-btn">退出登录</a>
                    <a href="profile.php" class="sidebar-btn">个人资料</a>
                <?php else: ?>
                    <a href="reg.php" class="sidebar-btn">注册</a>
                    <a href="login.php" class="sidebar-btn">登录</a>
                <?php endif; ?>
            </div>
        </div>
        <!-- 右侧内容栏 -->
        <div class="main">
            <div class="category-bar">
                <div class="category-btn-group">
                    <button class="category-btn">全部</button>
                    <button class="category-btn">公告</button>
                    <button class="category-btn">分享</button>
                    <button class="category-btn">提问</button>
                    <button class="category-btn">经验</button>
                    <button class="category-btn">讨论</button>
                </div>
                <div class="search-box">
                    <label>
                        <input type="text" class="search-input" placeholder="搜索帖子...">
                    </label>
                    <button class="search-btn">搜索</button>
                </div>
            </div>
            <div class="waterfall">
                <a href="detail.php" class="card" style="text-decoration:none; color:inherit;">
                    <h5>【公告】论坛新功能上线</h5>
                    <p>我们上线了全新的瀑布流首页，欢迎大家体验！</p>
                </a>
                <a href="detail.php" class="card" style="text-decoration:none; color:inherit;">
                    <h5>【分享】我的学习心得</h5>
                    <p>最近在学习前端开发，收获很大，欢迎交流！</p>
                </a>
                <a href="detail.php" class="card" style="text-decoration:none; color:inherit;">
                    <h5>【提问】如何高效背单词？</h5>
                    <p>有没有背单词的好方法推荐？</p>
                </a>
                <a href="detail.php" class="card" style="text-decoration:none; color:inherit;">
                    <h5>【经验】时间管理技巧</h5>
                    <p>合理规划时间，让生活更高效！</p>
                </a>
                <a href="detail.php" class="card" style="text-decoration:none; color:inherit;">
                    <h5>【讨论】你喜欢早起吗？</h5>
                    <p>早起真的有用吗？大家怎么看？</p>
                </a>
                <a href="detail.php" class="card" style="text-decoration:none; color:inherit;">
                    <h5>【公告】论坛维护通知</h5>
                    <p>本周末论坛将进行维护，敬请谅解。</p>
                </a>

            </div>
        </div>
    </div>
    <?php include 'float-ball.html'; ?>
<script>

</script>
</body>
</html>