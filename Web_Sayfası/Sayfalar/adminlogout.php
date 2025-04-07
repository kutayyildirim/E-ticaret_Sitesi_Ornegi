<?php
session_start();
session_unset();
session_destroy();
header('Location: admingiris.html');
exit();
?>
