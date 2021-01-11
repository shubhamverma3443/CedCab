<?php
session_start();
$currentL = $_POST['currentL'];
$dropL = $_POST['dropL'];
$cabType = $_POST['cabType'];
$luggage = $_POST['luggage'];
if ($luggage == '') {
    $luggage = 0;
}
$count = $_POST['count'];
$init = '';
$final = '';
$con = mysqli_connect('localhost', 'root', '', 'cedcab');
if ($con) {
    $sql = "select name,distance from location";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['name'] == $currentL) {
                $init = $row['distance'];
            } elseif ($row['name'] == $dropL) {
                $final = $row['distance'];
            }
        }

        (int)$totalDis = abs((int)$final - (int)$init);
        if ($cabType == 'CedMicro') {
            $lFare = luggageFare($luggage);
            $cabFare = Fare($totalDis, 13.50, 12.00, 10.20, 8.50);
            display($lFare, $cabFare, 50);
        } elseif ($cabType == 'CedMini') {
            $lFare = luggageFare($luggage);
            $cabFare = Fare($totalDis, 14.50, 13.00, 11.20, 9.50);
            display($lFare, $cabFare, 150);
        } elseif ($cabType == 'CedRoyal') {
            $lFare = luggageFare($luggage);
            $cabFare = Fare($totalDis, 15.50, 14.00, 12.20, 10.50);
            display($lFare, $cabFare, 200);
        } elseif ($cabType == 'CedSUV') {
            $lFare = 2 * luggageFare($luggage);
            $cabFare = Fare($totalDis, 16.50, 15.00, 13.20, 11.50);
            display($lFare, $cabFare, 250);
        }
    }
} else {
    echo "<script>alert('Try Again');window.location.href='index.php';</script>";
}
function Fare($dis, $ten, $fifty, $hundred, $above)
{
    if ($dis <= 10) {
        $FareAmount = $dis * $ten;
        return $FareAmount;
    } elseif ($dis <= 60 && $dis > 10) {
        $y = 10 * $ten;
        $x = ($dis - 10) * $fifty;
        return $x + $y;
    } elseif ($dis <= 160 && $dis > 50) {
        $y = 10 * $ten;
        $x = 50 * $fifty;
        $z = ($dis - 60) * $hundred;
        return $y + $x + $z;
    } elseif ($dis > 160) {
        $y = 10 * $ten;
        $x = 50 * $fifty;
        $z = 100 * $hundred;
        $k = ($dis - 160) * $above;
        return $y + $x + $z + $k;
    }
}

function luggageFare($lf)
{
    if ($lf == "" || $lf == 0) {
        return 0;
    } elseif ($lf <= 10) {
        return 50;
    } elseif ($lf <= 20 && $lf > 10) {
        return 100;
    } elseif ($lf > 20) {
        return 200;
    }
}

function display($cbFare, $lgFare, $extra)
{
    $tf = $cbFare + $lgFare + $extra;
    $_SESSION['cab_type'] = $GLOBALS['cabType'];
    $_SESSION['ride_from'] = $GLOBALS['currentL'];
    $_SESSION['ride_to'] = $GLOBALS['dropL'];
    $_SESSION['total_distance'] = $GLOBALS['totalDis'];
    $_SESSION['luggage'] = $GLOBALS['luggage'];
    $_SESSION['total_fare'] = $tf;
    echo $GLOBALS['currentL'], " &#8594; ", $GLOBALS['dropL'], "<br>";
    echo "Luggage: ", $GLOBALS['luggage'], "Kg<br>";
    echo "Cab Type: ", $GLOBALS['cabType'], '<br>';
    echo "Total Distance: ", $GLOBALS['totalDis'], "Km <br>";
    echo "<hr>";
    echo "Total Fare:  Rs", $tf;
}
