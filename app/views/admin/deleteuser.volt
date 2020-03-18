{{ content() }}
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Удаление пользователя</h2>
            <h5><input type="checkbox" id="user{{user.id}}" name="vehicle1" value="Bike" checked="checked">Активный</h5>
            <h5><input type="checkbox" id="user{{user.id}}" name="vehicle1" value="Bike">Не активный</h5>
            <p></p>
            {%for user in users%}
                {% if user.status == 1 %}
                    <p>{{user.name}} <input type="checkbox" id="user" name="vehicle1" value="Bike" checked="checked" data-id="{{user.id}}"></p>
                {% else %}
                    <p>{{user.name}} <input type="checkbox" id="user" name="vehicle1" value="Bike" data-id="{{user.id}}"></p>
                {% endif %}
            {%endfor%}
        </div>
    </div>
</div>
