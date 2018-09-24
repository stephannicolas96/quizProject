<div id="duelCreation" class="modal">
    <form action="#" method="POST">
        <div class="modal-content">
            <!-- OPPONENT SELECTION -->
            <div class="input-field">
                <input id="opponentUsername" name="opponentUsername" type="text"/>
                <label for="opponentUsername"><?= defined('OPPONENT_USERNAME') ? OPPONENT_USERNAME : 'Opponent usename' ?></label>
            </div>
            <input type="submit" name="randomOpponent" value="RANDOM OPPONENT"/>
            <input type="submit" name="chosenOpponent" value="CHOSEN OPPONENT" />
        </div>
    </form>
</div>
<div id="duelList" class="modal bottom-sheet">
    <div class="modal-content">

    </div>
</div>