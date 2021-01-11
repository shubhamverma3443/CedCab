<?php
session_start();
if (isset($_SESSION['uname'])) {
    $name = $_SESSION['uname'];
    $cab_type=$_SESSION['cab_type'];
    $ride_from = $_SESSION['ride_from'];
    $ride_to = $_SESSION['ride_to'];
    $total_distance = $_SESSION['total_distance'];
    $luggage = $_SESSION['luggage'];
    $total_fare = $_SESSION['total_fare'];
    $con = mysqli_connect('localhost', 'root', '', 'cedcab');
    if ($con) {
        $sql2 = "select user_id from user where email_id='$name'";
        $result = $con->query($sql2);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['userid']=$row['user_id'];
                $customer_user_id = $row['user_id'];
            }
            $sql = "INSERT INTO ride (ride_id, ride_date, cab_type,ride_from, ride_to, total_distance, luggage, total_fare, status, customer_user_id) VALUES (NULL, current_timestamp(),'$cab_type', '$ride_from', '$ride_to', '$total_distance', '$luggage', '$total_fare', '1', '$customer_user_id')";
            if ($con->query($sql)) {
                echo "<script>alert('Booking Success');window.location.href='history.php';</script>";
            } else {
                echo "<script>alert('Booking fail');window.location.href='index.php';</script>";
            }
        } else {
            echo "<script>alert('Try again')</script>";
        }
    } else {
        header('location:login.php');
    }
}else{
    echo "<script>alert('Please Login First');window.location.href='../Common/login.php'</script>";
}
