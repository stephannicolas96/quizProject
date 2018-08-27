<?php
include path::getLayout() . 'modalLogin.php';
include path::getLayout() . 'modalRegistration.php';
include path::getLayout() . 'modalForgotPassword.php';
include path::getLayout() . 'modalLogout.php';
?>
<nav class="navbar navbar-expand-sm">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php"><?= home ?></a>
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
            <li>
                <form action="action" method='GET'>
                    <select name="lang" id="language" style="width:300px;">
                        <option value='fr' data-image="assets/images/msdropdown/icons/blank.gif" data-imagecss="flag fr" data-title="France"><?= french ?></option>
                        <option value='en' data-image="assets/images/msdropdown/icons/blank.gif" data-imagecss="flag en" data-title="United-Kingdom"><?= english ?></option>
                    </select>  
                </form>
            </li>
        </ul>
    </div>  
</nav>
<script>
    $(document).ready(function () {
        $('languageSelect').on('change', function () {
            document.forms['languageSelection'].submit();
        });
         $("#language").msDropdown();
    });
</script>