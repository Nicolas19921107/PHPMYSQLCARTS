<?php include __DIR__ . '/phphtml/init.php';

$title = '資料列表';

// 每頁需產生幾筆資料
$infoperpage = 3;

// 設定使用者目前查看第幾頁，預設值為 1
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;


// 共有幾筆資料
// $totalcount = $pdo->query("SELECT count(1) FROM `order_list`")->fetch(PDO::FETCH_NUM)[0];
$totalcc = sprintf("SELECT count(1) FROM `order_list` ol LEFT JOIN `order_detail` od ON ol.Carts_Id=od.Order_Sid LEFT JOIN `products_food` pf ON od.Product_Sid=pf.product_id WHERE ol.Customer_Id='%s'", $_SESSION['user']['account']);

$totalcount = $pdo->query($totalcc)->fetch(PDO::FETCH_NUM)[0];

// 需要幾頁才能製作分頁按鈕( 無條件進入法 )
$totalpage = ceil($totalcount / $infoperpage);

// 讓 $page 的值在安全範圍內
if ($page < 1) {
    header('Location:?page=1');
}
if ($page > $totalpage) {
    header('Location:?page=' . $totalpage);
}

// 關鍵字查詢
$Keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

$where = 'WHERE 1';
if (!empty($Keyword)) {
    $where .= "AND `name` LIKE '%{$Keyword}%' ";
}

$sqlquery = sprintf("SELECT ol.*,od.*,pf.* FROM `order_list` ol LEFT JOIN `order_detail` od ON ol.Carts_Id=od.Order_Sid LEFT JOIN `products_food` pf ON od.Product_Sid=pf.product_id WHERE ol.Customer_Id='%s' ORDER BY `ol`.`Carts_Id` ASC LIMIT %s,%s", $_SESSION['user']['account'], ($page - 1) * $infoperpage, $infoperpage);


$rows = $pdo->query($sqlquery)->fetchAll();
?>
<?php include __DIR__ . '/phphtml/head.php'; ?>
<?php include __DIR__ . '/phphtml/navbar.php'; ?>
<style>
    .table img {
        width: 100px;
    }
</style>
<div class="container">
    <!-- <div class="row">
        <div class="col">
            <form action="data-list.php" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" name="keyword" value="<?= htmlentities($Keyword) ?>" aria-label=" Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div> -->
    <div class="row mx-auto">
        <div class="col">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">流水編號</th>
                        <th scope="col">訂單編號</th>
                        <th scope="col">產品圖片</th>
                        <th scope="col">產品名稱</th>
                        <th scope="col">品牌名稱</th>
                        <th scope="col">產品價格</th>
                        <th scope="col">產品數量</th>
                        <th scope="col">訂單總價</th>
                        <th scope="col">編輯資料</th>
                        <!-- <th scope="col">刪除資料</th> -->
                        <th scope="col">刪除資料</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr data-sid="<?= $r['Carts_Id'] ?>">
                            <td><?= $r['Order_Sid'] ?></td>
                            <td><?= $r['Sid'] ?></td>
                            <td><img src="../Homework/image/<?= $r['product_id'] ?>.png"></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['brand'] ?></td>
                            <td><?= $r['price'] ?></td>
                            <td><?= $r['Order_Amount'] ?></td>
                            <td><?= $r['Order_Total'] ?></td>
                            <td>
                                <a href="order-edit.php?sid=<?= $r['Sid'] ?>&qty=<?= $r['Order_Amount'] ?>">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                            </td>
                            <!-- <td>
                                如果選擇 取消 ，會 return false，資料不會傳送給 data_delete_test.php；若選擇 確定 ，則會連過去
                                <a href="data-delete.php?Order_Id=<?= $r['Order_Id'] ?>" onclick="return confirm('請問您確定要刪除編號<?= $r['Order_Id'] ?>的資料嗎?');">
                                    <i class="fas fa-backspace"></i>
                                </a>
                            </td> -->
                            <td>
                                <i class="fas fa-backspace deleteajax"></i>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mx-auto">
        <div class="col">
            <nav aria-label="Page navigation example mx-auto">
                <ul class="pagination justify-content-end">
                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?> "><a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fas fa-backward"></i></a></li>

                    <?php for ($i = $page - 2; $i <= $page + 2; $i++) :
                        if ($i >= 1 and $i <= $totalpage) : ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php
                        endif;
                    endfor; ?>

                    <li class="page-item <?= $page >= $totalpage ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fas fa-forward"></i></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php include __DIR__ . '/phphtml/footer.php'; ?>
<?php include __DIR__ . '/phphtml/script.php'; ?>

<script>
    const deleteorder = document.querySelector('table');
    deleteorder.addEventListener('click', function(event) {
        // console.log(event.target);
        // 判斷是否點擊到刪除鈕
        if (event.target.classList.contains('deleteajax')) {
            // console.log(event.target.closest('tr'));
            const Order_Sid = event.target.closest('tr');
            const Sid = Order_Sid.getAttribute('data-sid');
            console.log(Order_Sid);
            if (confirm(`請問您確定要刪除訂單編號${Sid}的資料嗎?`)) {
                fetch('order-delete-api.php?Carts_Id=' + Sid)
                    .then(r => r.json())
                    .then(Obj => {
                        if (Obj.success) {
                            Order_Sid.remove(); // 從 DOM 移除元素
                        } else {
                            alert(Obj.error);
                        }
                    })
            }
        }
    })
</script>