<?php include __DIR__ . '/phphtml/init.php';

$title = '修改資料';

$Order_Id = isset($_GET['Order_Id']) ? intval($_GET['Order_Id']) : 0;

$sqledit = "SELECT * FROM `order_list` WHERE Order_Id=$Order_Id";
$sqledit2 = "SELECT * FROM `order_detail` WHERE Order_Number=$Order_Id";

$info = $pdo->query($sqledit)->fetch();
$info2 = $pdo->query($sqledit2)->fetch();

if (empty($info) or empty($info2)) {
    header('Location:data-list.php');
    exit;
}
?>

<?php include __DIR__ . '/phphtml/head.php'; ?>
<?php include __DIR__ . '/phphtml/navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">編輯訂單資料</h5>
                    <!-- return false 相當於 preventdefault()  -->
                    <form name="orderaddform" onsubmit="checkForm(); return false;">
                        <div class="form-group">
                            <label for="onlineday">營運日</label>
                            <input type="text" class="form-control" id="onlineday" name="onlineday">
                            <small class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="day">星期幾</label>
                            <input type="text" class="form-control" id="day" name="day">
                            <small class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="totalamount">總運量</label>
                            <input type="text" class="form-control" id="totalamount" name="totalamount">
                            <small class="form-text"></small>
                        </div>
                        <button type="submit" class="btn btn-primary">提交資料</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/phphtml/footer.php'; ?>