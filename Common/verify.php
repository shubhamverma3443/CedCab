<?php
session_start();
$count = $_POST['count'];
if ($count > 1) {
    $data = $_POST['mval'];
    if ($_SESSION['motp'] == $data) {
        echo "success";
    } else {
        echo "fail";
    }
} else {
    $value = $_POST['value'];
    if ($_SESSION['otp'] == $value) {
        echo "success";
    } else {
        echo "fail";
    }
}
