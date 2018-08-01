<?php
include 'assets/layout/modalLogin.php';
include 'assets/layout/modalRegistration.php';
include 'assets/layout/modalForgotPassword.php';
include 'assets/layout/modalLogout.php';
?>
<nav class="navbar navbar-expand-sm">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="quizCreation.php">Create</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="leaderboardView.php">Leaderboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="duel.php">Duel</a>
            </li> 
            <?php
            $isLoggedSet = isset($_SESSION['logged']);
            if (!$isLoggedSet) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" href="#loginModal">Sign In</a>
                </li> 
                <?php } else if ($isLoggedSet && $_SESSION['logged']) { ?>
                <li>
                    <a class="nav-link" href="profileView.php">Profile</a>
                </li>
                <li class="nav-item">
                    <form action="index.php" method="POST">
                        <button class="nav-link" type="submit" name="logout">Logout</button>
                    </form>
                </li>    
            <?php } ?>
        </ul>
    </div>  
</nav>
