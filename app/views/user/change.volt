<div class="container m-5">
<h4 class="mb-4">Change a password</h4>
{{ form('session/change') }}
    <fieldset>
        <div class="mt-4">
            <label for='password'>
             Old Password
             </label>

             <div>
                 {{ password_field('old-password') }}
             </div>
        </div>

        <div class="mt-4">
            <label for='password'>
                New Password
            </label>

            <div>
                {{ password_field('new-password') }}
            </div>
        </div>

        <div class="mt-4">
                    <div>
                        {{ password_field('new-password-repeat') }}
                    </div>
                </div>

        <div class="mt-2">
            {{ submit_button('Change') }}
        </div>
    </fieldset>
{{ endForm() }}
</div>
