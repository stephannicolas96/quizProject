<footer>
    <a href="javascript:tarteaucitron.userInterface.openPanel();">Gestion des cookies</a>
</footer>

<script src="../assets/js/import/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="../assets/js/import/tarteaucitron/tarteaucitron.js"></script>
<script src="../assets/js/script.js"></script>
<?php if ($_SERVER['SCRIPT_NAME'] == '/views/creation.php' || $_SERVER['SCRIPT_NAME'] == '/views/duel.php') { ?>
    <script src="../assets/js/import/ace/ace.js"></script>
    <?php
}
if ($_SERVER['SCRIPT_NAME'] == '/views/creation.php' || $_SERVER['SCRIPT_NAME'] == '/views/duel.php' || $_SERVER['SCRIPT_NAME'] == '/views/leaderboard.php') {
    ?>
    <script src="../assets/js/editor.js"></script>
    <?php if ($_SERVER['SCRIPT_NAME'] == '/views/creation.php') { ?>
        <script src="../assets/js/creation.js"></script>
        <?php
    }
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.4.1/snap.svg-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pizza/0.2.1/js/pizza.min.js"></script>
    <script src="../assets/js/pizzaInitializer.js"></script>
    <script src="../assets/js/profile.js"></script>
<?php } ?>
</body> 
</html>