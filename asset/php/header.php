<?php require_once 'session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucfirst(basename($_SERVER['PHP_SELF'], '.php')) ?> | Animeet</title>
    <!--bootstrap css-->


    <link rel="stylesheet" href="asset/css/styleml.css">
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="asset/DataTables/datatables.min.css" />

</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!--brand-->
        <a class="navbar-brand d-flex justify-content-between align-items-baseline" href="index.php"><i class="fas fa-fire fa-lg"></i><span class="fw-bold h3" style="font-family: cursive;">A</span>nimeet</a>
        <!--toggler /collaspsing button-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links-->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php if (isset($cid) && !empty($cnoti)) : ?>
                        <div class=" alert alert-danger alert-dismissible noti">
                            <strong><?php echo $cnoti; ?></strong>
                            <button type="button" class="close" data-dismiss="alert"><i class="fa fa-window-close"></i></button>
                        </div>
                    <?php else : ?>
                        <span></span>
                    <?php endif; ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == "home.php" ? "active" : "" ?>" href="index.php"><i class="fas fa-home"></i>&nbsp;Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == "profile.php" ? "active" : "" ?>" href="profile.php"><i class="fas fa-business-time"></i>&nbsp;Profile</a>
                </li>
                <?php if (isset($cid) && !empty($cnoti)) : ?>
                    <li class="nav-item">
                        <a class="nav-link  d-flex  <?= basename($_SERVER['PHP_SELF']) == "profile.php" ? "active" : "" ?>" href="notification.php">
                            <i id="noti" class=" dot fas fas fa-bell"></i>&nbsp;Notification
                        </a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link  d-flex  <?= basename($_SERVER['PHP_SELF']) == "profile.php" ? "active" : "" ?>" href="notification.php">
                            <i id="noti" class="fas fas fa-bell"></i>&nbsp;Notification
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == "social.php" ? "active" : "" ?>" href="social.php"><i class="fas fa-users"></i>&nbsp;Social</a>
                </li>
                <li class="nav-item dropdown mr-5">
                    <a href="#" id="login" class="nav-link dropdown-toggle text-capitalize " id="navbardrop" data-toggle="dropdown">
                        <i class="fas fa-user-cog"></i>&nbsp;&nbsp;Hello! <?php if (isset($cemail)) {
                                                                                echo $fname;
                                                                            } ?>
                    </a>


                    <div class="dropdown-menu mr-5">
                        <?php if (isset($_SESSION['user'])) : ?>
                            <a href="#" class="dropdown-item"><i class="fas fa-user"></i>&nbsp;
                                <?php echo 'You Are Logged In.' ?>
                            <?php else : ?>
                                <a href="login.php" class="dropdown-item"><i class="fas fa-user"></i>&nbsp;
                                    <?php echo 'Login' ?>
                                <?php endif; ?>
                                </a>
                                <a href="manage.php" class="dropdown-item"><i class="fas fa-cog"></i>&nbsp;
                                    Manage Posts
                                </a>



                                <a href="asset/php/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>&nbsp;
                                    Logout
                                </a>
                    </div>
                </li>

            </ul>
        </div>
    </nav>


    <link rel="stylesheet" href="asset/css/styleml.css">


    <!--bootstrap js-->
    <script src="asset/js/bootstrap.bundle.min.js"></script>
    <!--bootstrap jquery-->
    <script src="asset/js/jquery-3.5.1.min.js"></script>
    <script src="asset/js/all.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            checkNoti();

            function checkNoti() {
                //check msg_status in users_chat table
                $.ajax({
                    url: 'asset/php/process.php',
                    method: 'get',
                    data: {
                        action: 'get_stat'
                    },
                    success: function(response) {
                        if (response == 'true') {
                            $("#noti").addClass('dot')

                        }
                    }
                });

                //check status in comments table
                CheckUsers_chatStatus();

                function CheckUsers_chatStatus() {
                    $.ajax({
                        url: 'asset/php/process.php',
                        method: 'get',
                        data: {
                            action: 'get_chatStat'
                        },
                        success: function(response) {
                            if (response == 'true') {
                                $("#noti").addClass('dot')

                            }
                        }
                    });
                }


            }


        });
    </script>
</body>

</html>