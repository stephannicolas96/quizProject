<script src="../assets/js/import/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="../assets/js/valueChecker.js"></script>
<script src="../assets/js/materializeInitializer.js"></script>
<script src="../assets/js/registration.js"></script>
<script src="../assets/js/login.js"></script>
<script src="../assets/js/generatePasswordInput.js"></script>
<script src="../assets/js/langageDropdown.js"></script>
<?php if ($_SERVER['SCRIPT_NAME'] == '/views/creation.php' || $_SERVER['SCRIPT_NAME'] == '/views/duel.php') { ?>
    <script src="../assets/js/import/ace/ace.js"></script>
    <script src="../assets/js/editor.js"></script>
    <?php if ($_SERVER['SCRIPT_NAME'] == '/views/creation.php') { ?>
        <script src="../assets/js/creation.js"></script>
    <?php }
    if ($_SERVER['SCRIPT_NAME'] == '/views/duel.php') {
        ?>
        <script src="../assets/js/duel.js"></script>
    <?php
    }
}
if ($_SERVER['SCRIPT_NAME'] == '/views/leaderboard.php') {
    ?>
    <script src="../assets/js/leaderboard.js"></script>
<?php } if ($_SERVER['SCRIPT_NAME'] == '/views/profile.php') {
    ?>
    <script src="../assets/js/profile.js"></script>
<?php } ?>
</body> 
</html>