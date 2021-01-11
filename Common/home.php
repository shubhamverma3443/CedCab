<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="index.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(110deg,
                    rgb(0, 0, 0, 0.7) 50%,
                    rgb(0, 0, 0, 0) 0%),
                url(img3.jpg) no-repeat center;
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }

        @media only screen and (max-width: 600px) {
            body {
                background: linear-gradient(0deg,
                        rgb(0, 0, 0, 0.6) 100%,
                        rgb(0, 0, 0, 0) 0%),
                    url(img3.jpg) no-repeat center;
            }
        }
    </style>
    <title>CedCab</title>
</head>

<body>
    <header class="d-flex flex-col-mdumn flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h1 class="h1 my-0 me-md-auto fw-normal"><span class="text-success">C</span>ed<span class="text-success">C</span>ab</h1>
        <nav class="my-2 my-md-0 me-md-3">
            <a class="p-2 text-dark" href="home.php">Home</a>
            <a class="p-2 text-dark" href="#">Contact</a>
            <a class="p-2 text-dark" href="login.php">Login</a>
            <a class="p-2 text-dark" href="signup.php">Signup</a>
        </nav>
    </header>
    <div class="container-fluid text-light text-center">
        <h1 class="display-4 fw-bold">
            Book a City Taxi to your destination in town
        </h1>
        <h1 class="display-6 text-success">
            Choose from a range of categories and prices
        </h1>
    </div>
    <?php include '../User/bookdata.php' ?>
    <footer class="py-2 text-muted text-center text-small bg-light">
        <p class="mb-1">© 2017–2020 CedCab</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
</body>

</html>