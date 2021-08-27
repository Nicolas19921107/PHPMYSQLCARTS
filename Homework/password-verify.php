<?php

$p = '$2y$10$xWfIa0u6oKXHC9CHXOH/q.wqFo5JgFmAH2zomN0SCPXds9oL.8bGm';
echo password_verify('ab123456', $p) ? '正確' : '錯誤';
