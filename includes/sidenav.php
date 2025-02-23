<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../admin_Login.php"); // Redirect to the dashboard if already logged in
    exit();
}
?>

<style>
    .user-info {
        position: fixed;
        bottom: 20px;
        left: 10%;
        color:antiquewhite;
    }
</style>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="../Dashboard/Dashboard.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#scollapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Students
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="scollapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="../student/new.php"><i class="fa fa-bars"></i> &nbsp;&nbsp;New</a>
                        <a class="nav-link" href="../student/manage.php"><i class="fa fa-server"></i> &nbsp;&nbsp;Manage</a>
                    </nav>
                </div>


                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#scollapseLayoutsdonar" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-money-bill-wave"></i></div>
                    Donars
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="scollapseLayoutsdonar" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="../donar/new.php"><i class="fa fa-bars"></i> &nbsp;&nbsp;New</a>
                        <a class="nav-link" href="../donar/manage.php"><i class="fa fa-server"></i> &nbsp;&nbsp;Manage</a>
                    </nav>
                </div>


                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Activities
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="../Activity/new.php"><i class="fa fa-bars"></i> &nbsp;&nbsp;New</a>
                        <a class="nav-link" href="../Activity/manage.php"><i class="fa fa-server"></i> &nbsp;&nbsp;Manage</a>
                    </nav>
                </div>



                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#event" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-music"></i></div>
                    Events
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="event" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="../events/new.php"><i class="fa fa-bars"></i> &nbsp;&nbsp;New</a>
                        <a class="nav-link" href="../events/manage.php"><i class="fa fa-server"></i> &nbsp;&nbsp;Manage</a>
                    </nav>
                </div>


                <a class="nav-link collapsed" href="../donation/manage.php">
                    <i class="fas fa-donate"></i>
                    &nbsp; Donations
                </a>

                <a class="nav-link collapsed" href="../message/manage.php">
                    <i class="fas fa-message"></i>
                    &nbsp; Messages
                </a>

                <div class="user-info">
                    Logged in as: <span id="username"><?php echo $_SESSION['email']; ?></span>
                </div>

            </div>
        </div>

    </nav>
</div>