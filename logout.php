<?php
session_start();
unset($_SESSION['sUserId']);
session_destroy();

header("Location: login");
exit;
