<?php
$uid = $_SESSION['userid'];
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container py-5">
    <form method="POST" class="my-3">
        <div class="row justify-content-md-center">
            <div class="col-md-3 mb-2">
                <select name="filter1" class="form-select" aria-label="Default select example">
                    <option value="">--Select Sorting Column--</option>
                    <option value="ride_date">Ride Date</option>
                    <option value="total_fare">Fair</option>
                </select>
            </div>
            <div class="col-md-3 mb-2">
                <select name="filter2" class="form-select" aria-label="Default select example">
                    <option value="">--Select Sorting type--</option>
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" name="submit" class="btn btn-success mb-2"><i class="fa fa-sort" aria-hidden="true"></i></button>
                <button class="btn btn-success mb-2"><i class="fa fa-refresh" aria-hidden="true"></i></button>
            </div>
        </div>
    </form>
    <form method="POST" class="my-3">
        <div class="row justify-content-md-center">
            <div class="col-md-3 mb-2">
                <select name="filter1" class="form-select" aria-label="Default select example">
                    <option value="">--Select Filter--</option>
                    <option value="month">Monthly</option>
                    <option value="week">Weekly</option>
                </select>
            </div>
            <div class="col-md-3 mb-2">
                <select name="filter2" class="form-select" aria-label="Default select example">
                    <option value="">--Select Cab Type--</option>
                    <option value="CedMicro">CedMicro</option>
                    <option value="CedMini">CedMini</option>
                    <option value="CedRoyal">CedRoyal</option>
                    <option value="CedSUV">CedSUV</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" name="submit2" class="btn btn-success mb-2"><i class="fa fa-filter" aria-hidden="true"></i></button>
                <button class="btn btn-success mb-2"><i class="fa fa-refresh" aria-hidden="true"></i></button>
            </div>
        </div>
    </form>
    <?php
    if (isset($_POST['submit']) || isset($_POST['submit2'])) {
    ?>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>SNo.</th>
                <th>Ride Date</th>
                <th>Cab Type</th>
                <th>From</th>
                <th>To</th>
                <th>Total Distance(km)</th>
                <th>Luggage(kg)</th>
                <th>Total Fare(Rs)</th>
                <th>Status</th>
            </tr>
        <?php
        $con = mysqli_connect('localhost', 'root', '', 'cedcab');
        if ($con) {
            if (isset($_POST['submit'])) {
                $f1 = $_POST['filter1'];
                $f2 = $_POST['filter2'];
                if ($f2 != '' && $f1 != '') {
                    $sql = "select ride_date,cab_type,ride_from,ride_to,total_distance,luggage,total_fare,status from ride where customer_user_id='$uid' ORDER BY $f1  $f2";
                } else {
                    $sql = "select ride_date,cab_type,ride_from,ride_to,total_distance,luggage,total_fare,status from ride where customer_user_id='$uid'";
                }
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>', $i, '</td>';
                        foreach ($row as $x => $y) {
                            if ($x == 'status') {
                                if ($y == '0') {
                                    echo '<td>', 'Cancelled', '</td>';
                                } elseif ($y == '1') {
                                    echo '<td>', 'Pending', '</td>';
                                } elseif ($y == '2') {
                                    echo '<td>', 'Completed', '</td>';
                                }
                            } else {
                                echo '<td>', $y, '</td>';
                            }
                        }
                        $i++;
                    }
                } else {
                    echo "<script>alert('Value not found...')</script>";
                }
            } else {
                $f1 = $_POST['filter1'];
                $f2 = $_POST['filter2'];
                if ($f1 != '') {
                    if ($f1 == 'month') {
                        $f1 = 31;
                    } elseif ($f1 == 'week') {
                        $f1 = 8;
                    } else {
                        $f1 = 365;
                    }
                    if ($f2 != '') {
                    }
                }
                if ($f2 != '' && $f1 != '') {
                    $sql = "select ride_date,cab_type,ride_from,ride_to,total_distance,luggage,total_fare,status from ride where datediff(now(),`ride_date`) <$f1 and customer_user_id='$uid' and cab_type='$f2' order by ride_date desc ";
                } elseif ($f1 != '') {
                    $sql = "select ride_date,cab_type,ride_from,ride_to,total_distance,luggage,total_fare,status from ride where datediff(now(),`ride_date`) <$f1 and customer_user_id='$uid' order by ride_date desc ";
                } elseif ($f2 != '') {
                    $sql = "select ride_date,cab_type,ride_from,ride_to,total_distance,luggage,total_fare,status from ride where customer_user_id='$uid' and cab_type='$f2' order by ride_date desc ";
                }else{
                    $sql = "select ride_date,cab_type,ride_from,ride_to,total_distance,luggage,total_fare,status from ride where customer_user_id='$uid' order by ride_date desc ";
                }
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>', $i, '</td>';
                        foreach ($row as $x => $y) {
                            if ($x == 'status') {
                                if ($y == '0') {
                                    echo '<td>', 'Cancelled';
                                } elseif ($y == '1') {
                                    echo '<td>', 'Pending';
                                } elseif ($y == '2') {
                                    echo '<td>', 'Completed', '</td>';
                                }
                            } else {
                                echo '<td>', $y, '</td>';
                            }
                        }
                        echo '</tr>';
                        $i++;
                    }
                }
            }
        }
    }

        ?>
        </table>
</div>