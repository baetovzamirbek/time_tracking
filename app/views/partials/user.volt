<h4 class="text-center">    <code>{{role}}</code></h4>

<p>
{% if role == '' %}
{{ link_to('user/index', 'Log in') }}
{% endif %}

{% if role == '1' %}
{{ link_to('user/index', 'Log in') }}
{{ link_to('user/logout', 'Log out') }}
{{ link_to('user/change', 'Change password') }}
{% endif %}

{% if role == '2' %}
<p>{{ link_to('user/logout', 'Log out') }}<p>
<p></p>
<p>{{ link_to('admin/late', 'Страница опозданий') }}</p>
<p>{{ link_to('admin/newuser', 'Добавление нового пользователя') }}</p>
<p>{{ link_to('admin/deleteuser', 'Удаление пользователя') }}</p>
<p>{{ link_to('admin/notWorkDays', 'Страница нерабочих дней') }}</p>
{% endif %}
</p>
<div class="m-2">
    <form action method="POST">
        <select name="select_month" id="form-control" onclick="this.form.submit();">
            {%for  key, value in months%}
                   <option value="{{key}}">{{value}}</option>
            {%endfor%}
        </select>
    </form>
</div>

<div class="row ml-5 mt-5">
    <h3>{{todayMonth}}</h3>
</div>

<div class="ml-5">
    <p>Amount of days in month: <code>{{totalDays}} days</code></p>
    <p>Amount of working days in month: <code>{{totalWorkingDays}} days</code></p>
</div>

<table class="table">
    <thead>
        <tr class="showOnlyToday">
            <th scope="col">Weekday</th>
            {%for user in users%}
            <th scope="col">{{user.name}}</th>
            {%endfor%}
        </tr>
    </thead>
    <tbody>
        {%for data in data%}
            {% if today == data['number'] %}
                <tr class="showOnlyToday">
            {% else %}
                <tr>
            {% endif %}
            
            {% if data['day']==0 or data['day']==6 or data['notWork']!=0%}
                <th class="rest"><p>{{ data['weekday']}}</p> <p class="text-numb">{{ data['number']}}</p></th>
                {% else %}
                <th><p>{{ data['weekday']}}</p> <p class="text-numb">{{ data['number']}}</p></th>


                {%for start in  data['tracking']%}
                    <td>

                    {% if role =='2' %}
                        {%for byUser in  start['trackingByUser']%}
                              <p><span><input type="time" value="{{byUser.start_time}}" id="edit_start" data-id="{{start['id_edit']}}"/></span>
                              <span><input type="time" value="{{byUser.end_time}}" id="edit_stop" data-id="{{start['id_edit']}}"/></span></p>
                        {%endfor%}
                        {% if start['totalTimeDay']['hour'] == 0 and start['totalTimeDay']['minute'] == 0 %}
                        {% else %}
                             <p class="mt-5">Total: {{start['totalTimeDay']['hour']}}:{{start['totalTimeDay']['minute']}} </p>
                        {% endif %}
                        {% if start['lessTimeDay']['hour'] > -1 %}
                              <p class="text-center"><code>   Less:  {{start['lessTimeDay']['hour']}}:{{start['lessTimeDay']['minute']}} </code></p>
                        {% endif %}
                        {% if start['stopButtonStatus'] == 1 %}
                               <button type="button" class="btn btn-danger" id="stop_button" style="display: show" data-id="{{start['id']}}">Stop</button>
                        {% endif %}
                    {% endif %}

                    {% if role == '1' or role == '' %}
                        {% for byUser in  start['trackingByUser'] %}
                             <p><span>{{byUser.start_time}}</span> <span>-</span>
                            <span>{{byUser.end_time}}</span></p>
                        {%endfor%}
                        {% if start['totalTimeDay']['hour'] == 0 and start['totalTimeDay']['minute'] == 0 %}
                        {% else %}
                            <p class="mt-5">Total: {{start['totalTimeDay']['hour']}}:{{start['totalTimeDay']['minute']}} </p>
                        {% endif %}
                        {% if start['lessTimeDay']['hour'] > -1 %}
                            <p class="text-center"><code>   Less:  {{start['lessTimeDay']['hour']}}:{{start['lessTimeDay']['minute']}} </code></p>
                        {% endif %}
                    {% endif %}

                    {% if role == '1' %}
                         {% if start['stopButtonStatus'] == 1 and user_id == start['id_user']%}
                         <button type="button" class="btn btn-danger" id="stop_button" style="display: show" data-id="{{start['id']}}">Stop</button>
                         {% else %}
                         {% if start['day'] == data['number'] and user_id == start['id_user'] %}
                         <button type="button" class="btn btn-danger" id="start_button" style="display: show" data-id="{{start['id_user']}}">Start</button>
                         {% endif %}
                         {% endif %}
                    {% endif %}
                    </td>
                {%endfor%}

            {% endif %}
            </tr>
        {%endfor%}
    </tbody>
</table>