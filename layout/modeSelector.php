<?php include_once path::getControllersPath() . 'modeSelector.php'; ?>
<div id="modeSelector">
    <?php foreach($allTypes as $id => $type) { ?>
        <div>
            <input id="<?= $type->type ?>" name="mode" type="radio" <?= ($id + 1 == $currentType) ? 'checked' : '' ?>/>
            <label for="<?= $type->type ?>"><img src="../assets/images/<?= $type->type ?>.png" /></label>
        </div>
    <?php } ?>
</div>