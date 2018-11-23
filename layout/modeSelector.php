<?php include_once path::getControllersPath() . 'modeSelector.php'; ?>
<div id="modeSelector">
    <?php foreach ($allLangages as $id => $langage) { ?>
        <div>
            <input id="<?= $langage->name ?>" name="mode" type="radio" <?= ($id + 1 == $currentLangage) ? 'checked' : '' ?>/>
            <label for="<?= $langage->name ?>"><img src="../assets/images/langages/<?= $id + 1 ?>" /></label>
        </div>
    <?php } ?>
</div>