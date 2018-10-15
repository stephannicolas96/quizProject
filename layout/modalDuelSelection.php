<?php include_once path::getControllersPath() . 'modalDuelSelection.php'; ?>
<div id="duelCreation" class="modal bottom-sheet">
    <form action="#" method="POST">
        <div class="modal-content">
            <!-- LANGAGE SELECTION -->
            <div id="duelModeSelector">    
                <div>
                    <input id="duelRandom" name="mode" type="radio" value="0" checked/>
                    <label for="duelRandom"><img src="../assets/images/any.png" /></label>
                </div>
                <?php foreach ($allLangages as $id => $langage) { ?>
                    <div>
                        <input id="duel<?= $langage->name ?>" name="mode" type="radio" value="<?= $id + 1 ?>" />
                        <label for="duel<?= $langage->name ?>"><img src="../assets/images/<?= $langage->name ?>.png" /></label>
                    </div>
                <?php } ?>
            </div>
            <!-- OPPONENT SELECTION -->
            <div class="input-field">
                <input id="opponentUsername" class="autocomplete" name="opponentUsername" type="text" autocomplete="off"/>
                <label for="opponentUsername"><?= OPPONENT_USERNAME ?></label>
            </div>
            <input type="submit" name="randomOpponent" value="RANDOM OPPONENT"/>
            <input type="submit" name="chosenOpponent" value="CHOSEN OPPONENT" />
        </div>
    </form>
    <ul class="duelList big-container">
        <?php foreach ($duels as $duel) { ?>
            <li>
                <div class="<?= $duel->currentUserState ?>"></div>
                <div class="<?= $duel->opponentState ?>"></div>
                <img class="userImg small" src="../assets/images/userImages/<?= $duel->currentUserImage ?>" />
                <p><?= $duel->currentUser ?></p>
                <img class="imgSize small" src="../assets/images/vs.png">
                <p><?= $duel->opponent ?></p>
                <img class="userImg small" src="../assets/images/userImages/<?= $duel->opponentImage ?>" />
                <?php if ($duel->currentUserState == 'inProgress' && $duel->opponentState == 'inProgress') { ?>
                    <a href="battle-<?= $duel->duelId ?>.html" title="Continue Battle"><?= CONTINU ?></a>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>
</div>
<div id="duelList" class="modal bottom-sheet">
    <div class="modal-content">

    </div>
</div>