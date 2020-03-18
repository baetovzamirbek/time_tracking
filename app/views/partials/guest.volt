<h4 class="text-center">    <code>Guest</code></h4>

<p>{{ link_to('user/index', 'Log in') }}
</p>
<div class="m-2">
    <form action method="POST">
        <select name="select_month" id="form-control" onclick="this.form.submit();">
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
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
                    {%for byUser in  start['trackingByUser']%}
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
                    </td>
                {%endfor%}

            {% endif %}
            </tr>
        {%endfor%}
    </tbody>
</table>