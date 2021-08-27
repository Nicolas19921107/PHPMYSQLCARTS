<!-- <nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <a class="navbar-brand text-dark" href="index-home.php">後台管理系統</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <?php if (isset($_SESSION['user'])) : ?>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="product-list.php">產品列表</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart-list.php">購物車</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link">歡迎回來!! <?= $_SESSION['user']['nickname'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile-edit.php">編輯個人資料</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Logout.php">登出</a>
                </li>
            </ul>
        <?php else : ?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="product-list.php">產品列表</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart-list.php">購物車</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="login.php">登入</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">註冊</a>
                </li>
            </ul>
        <?php endif; ?>
    </div>
</nav> -->

<style>
    .container-nav {
        width: 80vw;
        margin: 0 30px;
    }

    .nav-item {
        margin: 0 10px;
    }

    .nav-link {
        font-size: 1.2rem;
        font-weight: 700;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="homepageIcon">
        <a class="text-success fs-1" href="index-home.php">好好食飯</a>
    </div>

    <div class="container-nav">
        <!-- <a class="navbar-brand" href="#">好好食飯</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">商城</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">好食專欄</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">外送餐廳列表</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product-list.php">產品列表</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="cart-list.php">購物車</a>
                </li>
            </ul>
            <?php if (isset($_SESSION['user'])) : ?>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link">歡迎回來!! <?= $_SESSION['user']['nickname'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="data-list.php">我的訂單</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="#">會員資料</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Logout.php">登出</a>
                    </li>
                </ul>
            <?php else : ?>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">登入</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">註冊</a>
                    </li>
                </ul>
            <?php endif; ?>

        </div>
    </div>
</nav>