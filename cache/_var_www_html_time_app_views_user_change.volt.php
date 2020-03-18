<div class="container m-5">
<h4 class="mb-4">Change a password</h4>
<?= $this->tag->form(['session/change']) ?>
    <fieldset>
        <div class="mt-4">
            <label for='password'>
             Old Password
             </label>

             <div>
                 <?= $this->tag->passwordField(['old-password']) ?>
             </div>
        </div>

        <div class="mt-4">
            <label for='password'>
                New Password
            </label>

            <div>
                <?= $this->tag->passwordField(['new-password']) ?>
            </div>
        </div>

        <div class="mt-4">
                    <div>
                        <?= $this->tag->passwordField(['new-password-repeat']) ?>
                    </div>
                </div>

        <div class="mt-2">
            <?= $this->tag->submitButton(['Change']) ?>
        </div>
    </fieldset>
<?= $this->tag->endform() ?>
</div>
