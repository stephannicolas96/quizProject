<?php
include_once 'assets/classes/path.php'; //TEMP REMOVE
include_once path::getControllersPath() . 'duelSelectionController.php';
?>
<form action="#" method="POST">
    <!-- SCRIPTING LANGUAGE -->
    <label>
        <img src="assets/images/all.png" />
        <input type="radio" value="0" name="scriptingLanguage" checked/>
    </label>
    <label>
        <img src="assets/images/php.png" />
        <input type="radio" value="1" name="scriptingLanguage" />
    </label>
    <label>
        <img src="assets/images/cpp.png" />
        <input type="radio" value="2" name="scriptingLanguage" />
    </label>
    <label>
        <img src="assets/images/c.png" />
        <input type="radio" value="3" name="scriptingLanguage" />
    </label>

    <!-- DIFFICULTY -->
    <label>
        easy
        <input type="radio" value="0" name="difficulty" checked/>
    </label>
    <label>
        medium
        <input type="radio" value="1" name="difficulty" />
    </label>
    <label>
        difficult
        <input type="radio" value="2" name="difficulty" />
    </label>
    <label>
        expert
        <input type="radio" value="3" name="difficulty" />
    </label>

    <!-- OPPONENT SELECTION -->
    <input type="submit" name="randomOpponent" value="RANDOM OPPONENT"/>
    <input type="text" name="username" />
    <input type="submit" name="chosenOpponent" value="CHOSEN OPPONENT" />
</form>
<hr />
<ul>
    <li>

    </li>
</ul>