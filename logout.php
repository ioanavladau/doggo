<?php
session_start();
unset($_SESSION['sEmail']);
session_destroy();

header("Location: login");
exit;
