<?php include_once path::getControllersPath() . 'modalDuelSelection.php'; ?>
<div id="duelCreation" class="modal bottom-sheet">
    <form id="duelSelectionForm" action="#" method="POST">
        <div class="modal-content">
            <div class="success hidden"><p><?= SUCCESSFUL_DUEL_CREATION ?></p></div>
            <div class="content">
                <!-- LANGAGE SELECTION -->
                <div id="duelModeSelector">    
                    <div>
                        <input id="duelRandom" name="langage" type="radio" value="0" checked >
                        <label for="duelRandom"><img src="../assets/images/langages/0.png" /></label>
                    </div>
                    <?php foreach ($allLangages as $id => $langage) { ?>
                        <div>
                            <input id="duel<?= $langage->name ?>" name="langage" type="radio" value="<?= $id + 1 ?>" />
                            <label for="duel<?= $langage->name ?>"><img src="../assets/images/langages/<?= $id + 1 ?>.png" /></label>
                        </div>
                    <?php } ?>
                </div>
                <!-- OPPONENT SELECTION -->
                <div class="input-field">
                    <input id="opponentUsername" class="autocomplete" name="opponentUsername" type="text" autocomplete="off" />
                    <label for="opponentUsername"><?= OPPONENT_USERNAME ?></label>
                </div>
                <input type="submit" name="randomOpponent" value="RANDOM OPPONENT"/>
                <input type="submit" name="chosenOpponent" value="CHOSEN OPPONENT" />
            </div>
            <div class="loader small hidden"><img src="../assets/images/loading.gif"/></div>
        </div>
    </form>
    <ul class="duelList big-container">
        <?php foreach ($duels as $duel) { ?>
            <li>
                <div class="<?= $duel->userOneState ?>"></div>
                <div class="<?= $duel->userTwoState ?>"></div>
                <img class="userImg small" src="../assets/images/userImages/<?= $duel->userOneImage ?>" style="background-color: <?= '#' . $duel->userOneColor ?>" alt="user image" onerror="this.src='../assets/images/userImages/user-image.png'"  onabort="this.src='../assets/images/userImages/user-image.png'" />
                <p><?= $duel->userOne ?></p>
                <img class="langageImg small" src="../assets/images/langages/<?= $duel->idLangageName ?>.png">
                <p><?= $duel->userTwo ?></p>  
                <img class="userImg small" src="../assets/images/userImages/<?= $duel->userTwoImage ?>" style="background-color: <?= '#' . $duel->userTwoColor ?>" alt="user image" onerror="this.src='../assets/images/userImages/user-image.png'"  onabort="this.src='../assets/images/userImages/user-image.png'" />
                <?php if ($duel->userOneState == 'inProgress' && $duel->userTwoState == 'inProgress') { ?>
                    <a href="battle-<?= $duel->idDuel ?>.html" title="Continue Battle"><?= CONTINU ?></a>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>
</div>
<div id="duelList" class="modal bottom-sheet">
    <div class="modal-content">

    </div>
</div>