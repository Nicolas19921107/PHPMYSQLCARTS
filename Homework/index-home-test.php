<?php include __DIR__ . '/phphtml/init.php'; ?>
<?php include __DIR__ . '/phphtml/head.php'; ?>
<?php include __DIR__ . '/phphtml/navbar.php'; ?>

<div class="container">
    <h1>歡迎回來後台管理系統</h1>
</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="showModalClose();">Close</button>
                <button type=" button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/phphtml/footer.php'; ?>
<?php include __DIR__ . '/phphtml/script.php'; ?>
<script>
    function showModal() {
        $("#exampleModal").modal('show');
    }

    function showModalClose() {
        $("#exampleModal").modal('hide');
    }
</script>