<?= $this->getContent() ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Удаление пользователя</h2>
            <h5><input type="checkbox" id="user<?= $user->id ?>" name="vehicle1" value="Bike" checked="checked">Активный</h5>
            <h5><input type="checkbox" id="user<?= $user->id ?>" name="vehicle1" value="Bike">Не активный</h5>
            <p></p>
            <?php foreach ($users as $user) { ?>
                <?php if ($user->status == 1) { ?>
                    <p><?= $user->name ?> <input type="checkbox" id="user" name="vehicle1" value="Bike" checked="checked" data-id="<?= $user->id ?>"></p>
                <?php } else { ?>
                    <p><?= $user->name ?> <input type="checkbox" id="user" name="vehicle1" value="Bike" data-id="<?= $user->id ?>"></p>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
