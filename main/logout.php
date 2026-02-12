<?php
session_start();
session_unset();
session_destroy();

header("Location: /main/login.php"); // change to your login page
exit;