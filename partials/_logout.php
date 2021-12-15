<?php
session_start();
echo "Loggin in out..Please wait";
// session_unset();
session_destroy();
header("Location: /forums/");

?>