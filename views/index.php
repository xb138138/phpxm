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
                    <button class="category-btn" data-id="all">全部</button>
                    <?php
                      //导入数据层
                      require_once '../model/topicDao.php';
                      require_once '../model/boardDao.php';
                      //获取一级板块数据并输出一级
                      $parentBoards = get_son_boards(0);
                      foreach ($parentBoards as $parent) {
                          $parentBoardName = $parent['boardName'];
                          echo '<button class="category-btn"  data-id="' . $parent['boardid'] . '">' . htmlspecialchars($parent['boardName']) . '</button>';
                      }
                    ?>
                </div>
                <div class="search-box">
                    <label>
                        <input type="text" class="search-input" placeholder="搜索帖子...">
                    </label>
                    <button class="search-btn">搜索</button>
                </div>
            </div>
            <hr class="custom-hr">
            <div class="category-child">
                <div class="category-child-group" id="child-group">
                    <button class="category-child-btn">全部</button>
                    <?php
                    //获取一级版块的编号
                    $parentBoardId=$parent["boardid"];
                    //根据一级版块编号获取对应的所有子版块
                    $sonBoards=get_son_boards($parentBoardId);
                    //遍历$sonBoards
                    foreach($sonBoards as $son){
                        //获取子版块的名称
                        $sonBoardName=$son["boardName"];
                        //获取子版块的编号
                        $sonBoardId=$son["boardid"];
                        //根据子版块编号获取当前版块的最新帖子信息
                        $lastTopic=get_last_topic($sonBoardId);
                        //获取标题
                        $title=$lastTopic["title"];
                        //获取用户名
                        $uName=$lastTopic["uName"];
                        //获取发表时间
                        $publishTime=$lastTopic["publishTime"];
                    }
                    ?>
                    <button class="category-child-btn"><?php echo $sonBoardName; ?></button>
                </div>
                <div id="topic-count-display" class="topic-stats">

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
    document.addEventListener('DOMContentLoaded', () => {
        const childGroup = document.getElementById('child-group');
        const topicCountDisplay = document.getElementById('topic-count-display');
        const defaultSubCategories = `
        <button class="category-child-btn active" data-command="recommend">推荐</button>
        <button class="category-child-btn" data-command="newest">最新</button>
        <button class="category-child-btn" data-command="hottest">最热</button>
    `;

        childGroup.innerHTML = defaultSubCategories;
        topicCountDisplay.textContent = '推荐帖子';

        // 设置第一个"全部"按钮为激活状态
        const allButton = document.querySelector('.category-btn[data-id="all"]');
        if (allButton) {
            allButton.classList.add('active');
        }
        // 子分类按钮点击事件处理
        childGroup.addEventListener('click', async (e) => {
            const target = e.target;
            if (target.classList.contains('category-child-btn')) {
                childGroup.querySelectorAll('.category-child-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                target.classList.add('active');

                try {
                    // 处理帖子数量显示
                    if (target.dataset.command) {
                        // 处理推荐/最新/最热按钮
                        topicCountDisplay.textContent = `${target.textContent}帖子`;
                        return;
                    }

                    if (target.dataset.id) {
                        // 获取特定子版块的帖子数
                        const response = await fetch(`../api/get_board_topics.php?boardid=${target.dataset.id}`);
                        if (!response.ok) {
                            topicCountDisplay.textContent = '获取帖子数失败';
                            return;
                        }
                        const data = await response.json();
                        topicCountDisplay.textContent = `当前版块帖子总数: ${data.topicCount || 0}`;
                        return;
                    }

                    // 修改全部按钮的点击处理逻辑
                    if (target.textContent === '全部') {
                        const currentParentBtn = document.querySelector('.category-btn.active');
                        if (!currentParentBtn) {
                            topicCountDisplay.textContent = '请先选择主分类';
                            return;
                        }
                        const currentParentId = currentParentBtn.dataset.id;

                        try {
                            // 使用新的API接口获取父版块下所有子版块的帖子总数
                            const response = await fetch(`../api/get_parent_topics.php?parentid=${currentParentId}`);
                            if (!response.ok) {
                                topicCountDisplay.textContent = '获取帖子数失败';
                                return;
                            }
                            const data = await response.json();
                            if (data.status === 'success') {
                                topicCountDisplay.textContent = `当前版块帖子总数: ${data.totalTopics}`;
                            } else {
                                topicCountDisplay.textContent = '获取帖子数失败';
                            }
                        } catch(err) {
                            console.error('获取总帖子数失败:', err);
                            topicCountDisplay.textContent = '获取数据失败';
                        }
                    }
                } catch(err) {
                    console.error('操作失败:', err);
                    topicCountDisplay.textContent = '获取数据失败';
                }
            }
        });

        // 主分类按钮点击处理
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.addEventListener('click', async ({target}) => {
                // 移除其他按钮的active类
                document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
                target.classList.add('active');

                const pid = target.dataset.id;
                if(pid === 'all') {
                    childGroup.innerHTML = defaultSubCategories;
                    childGroup.querySelector('.category-child-btn').classList.add('active');
                    topicCountDisplay.textContent = '推荐帖子';
                    return;
                }

                try {
                    // 获取子版块数据和帖子总数
                    const response = await fetch(`../api/get_parent_topics.php?parentid=${pid}`);
                    const data = await response.json();

                    if (!response.ok || data.status !== 'success') {
                        childGroup.innerHTML = '<button class="category-child-btn active">获取数据失败</button>';
                        topicCountDisplay.textContent = '获取数据失败';
                        return;
                    }

                    // 构建子版块按钮HTML
                    childGroup.innerHTML = [
                        '<button class="category-child-btn active">全部</button>',
                        ...data.childBoards.map(child =>
                            `<button class="category-child-btn" data-id="${child.boardid}">
                                ${child.boardName}
                            </button>`
                        )
                    ].join('');

                    // 显示该分类下所有帖子总数
                    topicCountDisplay.textContent = `当前版块帖子总数: ${data.totalTopics || 0}`;

                } catch(err) {
                    console.error('获取子版块失败:', err);
                    childGroup.innerHTML = '<button class="category-child-btn active">获取数据失败</button>';
                    topicCountDisplay.textContent = '获取数据失败';
                }
            });
        });
    });
</script>
</body>
</html>