{{ content() }}
<div class="container">
    <div class="row">
        <h4 class="mb-4">Add a new user</h4>
        {{ form('admin/addToDb') }}

    <fieldset>
        <div class="mt-4">
            <label for='name'>
            Name
            </label>
            <div>
                {{ text_field('name') }}
            </div>
        </div>

        <div class="mt-4">
            <label for='login'>
                Login
            </label>
            <div>
                {{ text_field('login') }}
            </div>
        </div>

        <div class="mt-4">
            <label for='email'>
                Email
            </label>
            <div>
                {{ text_field('email') }}
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
            {{ submit_button('Add a new user    ') }}
        </div>
    </fieldset>
{{ endForm() }}  
    </div>
</div>
