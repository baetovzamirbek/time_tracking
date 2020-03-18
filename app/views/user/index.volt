<div class="container m-5">
<h4 class="mb-4">Login</h4>
{{ form('session/start') }}
    <fieldset>
        <div>
            <label for='user'>
                Username
            </label>

            <div>
                {{ text_field('user') }}
            </div>
        </div>

        <div class="mt-4">
            <label for='password'>
                Password
            </label>

            <div>
                {{ password_field('password') }}
            </div>
        </div>

        <div class="mt-2">
            {{ submit_button('Login') }}
        </div>
    </fieldset>
{{ endForm() }}
</div>
