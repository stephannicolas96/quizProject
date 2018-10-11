<div id="duelCreation" class="modal bottom-sheet">
    <form action="#" method="POST">
        <div class="modal-content">
            <!-- OPPONENT SELECTION -->
            <div class="input-field">
                <input id="opponentUsername" class="autocomplete" name="opponentUsername" type="text" autocomplete="off"/>
                <label for="opponentUsername"><?= OPPONENT_USERNAME ?></label>
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