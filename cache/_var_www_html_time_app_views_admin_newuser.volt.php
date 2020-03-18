<?= $this->getContent() ?>
<div class="container">
    <div class="row">
        <h4 class="mb-4">Add a new user</h4>
        <?= $this->tag->form(['admin/addToDb']) ?>

    <fieldset>
        <div class="mt-4">
            <label for='name'>
            Name
            </label>
            <div>
                <?= $this->tag->textField(['name']) ?>
            </div>
        </div>

        <div class="mt-4">
            <label for='login'>
                Login
            </label>
            <div>
                <?= $this->tag->textField(['login']) ?>
            </div>
        </div>

        <div class="mt-4">
            <label for='email'>
                Email
            </label>
            <div>
                <?= $this->tag->textField(['email']) ?>
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
            <?= $this->tag->submitButton(['Add a new user    ']) ?>
        </div>
    </fieldset>
<?= $this->tag->endform() ?>  
    </div>
</div>
