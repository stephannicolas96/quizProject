<?php include_once path::getControllersPath() . 'modalDuelSelection.php'; ?>
<div id="duelCreation" class="modal bottom-sheet">
    <form id="duelSelectionForm" action="#" method="POST">
        <div class="modal-content">
            <div class="success hidden"><p><?= SUCCESSFUL_DUEL_CREATION ?></p></div>
            <div class="errors hidden"></div>
            <div class="content">
                <!-- LANGAGE SELECTION -->
                <div id="duelModeSelector">    
                    <div>
                        <input id="duelRandom" name="langage" type="radio" value="0" checked >
                        <label for="duelRandom"><img src="../assets/images/langages/0" /></label>
                    </div>
                    <?php foreach ($allLangages as $id => $langage) { ?>
                        <div>
                            <input id="duel<?= $langage->name ?>" name="langage" type="radio" value="<?= $id + 1 ?>" />
                            <label for="duel<?= $langage->name ?>"><img src="../assets/images/langages/<?= $id + 1 ?>" /></label>
                        </div>
                    <?php } ?>
                </div>
                <!-- OPPONENT SELECTION -->
                <div class="input-field">
                    <input id="opponentUsername" name="opponentUsername" type="text" autocomplete="off" />
                    <label for="opponentUsername"><?= OPPONENT_USERNAME ?></label>
                </div>
                <input type="submit" class="btn-flat" name="randomOpponent" value="RANDOM OPPONENT"/>
                <input type="submit" class="btn-flat" name="chosenOpponent" value="CHOSEN OPPONENT" />
            </div>
            <div class="loader small hidden"><img src="../assets/images/loading.gif"/></div>
        </div>
    </form>
    
    
    <ul id="duelStates">
        <li>
            <?= IN_PROGRESS ?>
            <div class="inProgress"></div>
        </li>
        <li>
            <?= WAITING ?>
            <div class="waiting"></div>
        </li>
        <li>
            <?= DRAW ?>
            <div class="draw"></div>
        </li>
        <li>
            <?= LOST ?>
            <div class="lost"></div>
        </li>
        <li>
            <?= WON ?>
            <div class="won"></div>
        </li>
        <li>
            <?= EXPIRED_BUT_PLAYED ?>
            <div class="expiredButPlayed"></div>
        </li>
        <li>
            <?= EXPIRED ?>
            <div class="expired"></div>
        </li>
    </ul>
    
    
    <ul class="duelList big-container">
        <?php foreach ($duels as $duel) { ?>
            <li>
                <div class="<?= $duel->userOneState ?>"></div>
                <div class="<?= $duel->userTwoState ?>"></div>
                <img class="userImg small" src="../assets/images/userImages/<?= $duel->userOneImage ?>" style="background-color: <?= '#' . $duel->userOneColor ?>" alt="user image" onerror="this.src='../assets/images/userImages/user-image'"  onabort="this.src='../assets/images/userImages/user-image'" />
                <p><?= $duel->userOne ?></p>
                <img class="langageImg small" src="../assets/images/langages/<?= $duel->idLangageName ?>">
                <p><?= $duel->userTwo ?></p>  
                <img class="userImg small" src="../assets/images/userImages/<?= $duel->userTwoImage ?>" style="background-color: <?= '#' . $duel->userTwoColor ?>" alt="user image" onerror="this.src='../assets/images/userImages/user-image'"  onabort="this.src='../assets/images/userImages/user-image'" />
                <?php if ($duel->userOneImage == 'you' && $duel->userOneState == 'inProgress' || $duel->userTwoImage == 'you' && $duel->userTwoState == 'inProgress') { ?>
                    <a href="battle-<?= $duel->idDuel ?>" title="Continue Battle"><?= CONTINU ?></a>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>
</div>