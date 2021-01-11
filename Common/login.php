<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
         body {
            margin: 0;
            padding: 0;
            background: linear-gradient(180deg,
                    rgb(21, 115, 71, 1) 40%,
                    rgb(0, 0, 0, 0) 0%);
            background-size: 100% 150%;
            background-repeat: no-repeat;
        }
        @media only screen and (max-width: 600px) {
            #outer {
                width: 90% !important;
                margin: auto !important;
                margin-top:50px !important ;
                /* margin-bottom: 50px !important; */
            }
        }
    </style>
    <title>Login</title>
</head>

<body>
    <h1 class="display-4 fw-normal text-light text-center mt-5">Hey, good to see you again!</h1>
    <p class="fs-4 text-light text-center">Login to get going.</p>
    <div class="container w-25 px-5 pb-5 pt-2 my-5 bg-light shadow border rounded" id="outer">
    <a href="home.php" class="text-decoration-none text-dark"><h1 class=" text-center fw-normal my-4"><span class="text-success">C</span>ed<span class="text-success">C</span>ab</h1></a>
        <form method="POST">
            <div class="mb-3">
                <label for="inputPassword5" class="form-label">E-Mail</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="uname">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" name="pass">
            </div>
            <button type="submit" class="btn btn-success w-100" name="login">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>
<?php
session_start();
$status='';
$con = mysqli_connect('localhost', 'root', '', 'cedcab');
if (isset($_POST['login'])) {
    $uname = $_POST['uname'];
    $password = $_POST['pass'];
    if ($con) {
        $sql = "select * from login where name='$uname' AND password='$password'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['uname'] = $row['name'];
                $name=$row['name'];
                if ($row['type'] == 'user') {
                    $sql2 = "select status from user where email_id='$name'";
                    $result2 = $con->query($sql2);
                    if ($result2->num_rows > 0) {
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            $status = $row2['status'];
                        }
                    }
                    if ($status == '1') {
                        echo "<script>alert('Login Successfull..')</script>";
                        header('location:../User/index.php');
                    } else {
                        echo "<script>alert('Sorry you are blocked by admin..')</script>";
                    }
                } else {
                    header('location:../Admin/requests.php');
                }
            }
        }else{
            echo "<script>alert('Incorrect E-Mail or Passsword');</script>";
        }
    }
}

?>