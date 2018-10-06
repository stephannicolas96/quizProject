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
<script src="../assets/js/import/tarteaucitron/tarteaucitron.js"></script>
<script>
    tarteaucitron.init({
        "privacyUrl": "", /* Privacy policy url */

        "hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
        "cookieName": "tartaucitron", /* Cookie name */

        "orientation": "top", /* Banner position (top - bottom) */
        "showAlertSmall": false, /* Show the small banner on bottom right */
        "cookieslist": true, /* Show the cookie list */

        "adblocker": false, /* Show a Warning if an adblocker is detected */
        "AcceptAllCta": true, /* Show the accept all button when highPrivacy on */
        "highPrivacy": false, /* Disable auto consent */
        "handleBrowserDNTRequest": false, /* If Do Not Track == 1, accept all */

        "removeCredit": false, /* Remove credit link */
        "moreInfoLink": true, /* Show more info link */

        //"cookieDomain": ".my-multisite-domaine.fr" /* Shared cookie for subdomain */
    });
    (tarteaucitron.job = tarteaucitron.job || []).push('recaptcha');
</script>
</body> 
</html>