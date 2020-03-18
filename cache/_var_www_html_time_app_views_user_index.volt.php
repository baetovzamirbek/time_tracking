<div class="container m-5">
<h4 class="mb-4">Login</h4>
<?= $this->tag->form(['session/start']) ?>
    <fieldset>
        <div>
            <label for='user'>
                Username
            </label>

            <div>
                <?= $this->tag->textField(['user']) ?>
            </div>
        </div>

        <div class="mt-4">
            <label for='password'>
                Password
            </label>

            <div>
                <?= $this->tag->passwordField(['password']) ?>
            </div>
        </div>

        <div class="mt-2">
            <?= $this->tag->submitButton(['Login']) ?>
        </div>
    </fieldset>
<?= $this->tag->endform() ?>
</div>
