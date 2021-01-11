<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'cedcab');
if ($con) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <title>Document</title>
        <style>
        </style>
    </head>

    <body>
        <?php include 'header.php' ?>
        <?php include 'sort.php'?>
        <div class="container" id="div1">
            <form method="POST" id="form">
            </form>
        </div>
        <?php
        $sql = "select *from ride order by ride_date desc";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
        ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <th>SNo.</th>
                        <th>Ride Id</th>
                        <th>Ride Date</th>
                        <th>Cab Type</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Total Distance(km)</th>
                        <th>Luggage(kg)</th>
                        <th>Total Fare(Rs)</th>
                        <th>Status</th>
                        <th>Customer Id</th>
                    </tr>
            <?php
            $i=1;
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo "<td>$i</td>";
                foreach ($row as $x => $y) {
                    echo '<td>', $y, '</td>';
                }
                echo '</tr>';
                $i++;
            }
        }
    }
            ?>
                </table>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>

    </html>