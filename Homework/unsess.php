<?php session_start() ?>
<pre>
<?php
unset($_SESSION['cart']);
unset($_SESSION['order']);

echo 'SESSION 已清除';
?>
</pre>