{{ content() }}
<div class="container">
    <div class="row">
        <div class="col-12">
            <h4 class="text-center mt-5">Страница опозданий</h4>
        </div>
        <div class="col-12 mt-5">
            <h5>Начало рабочего дня</h5>
            <input type="time" id="typeTime" name="appt" value="{{startTime}}">
            <button type="button" class="btn btn-secondary" id="changeLateTime">Изменить</button>
        </div> 
        <div class="col-12 mt-5">
            <table class="table">
                <thead>
                    <tr class="showOnlyToday trst">
                        <th>Date</th>
                        {%for user in users%}
                            <th scope="col">{{user.name}}</th>
                        {%endfor%}
                    </tr>
                </thead>
                <tbody>
                    <tr class="trst">
                        {%for user in users%}
                            <td class="td{{user.id}}"></td>
                        {%endfor%}
                    </tr>

                        {%for date in dates%}
                        <tr class="trst">
                            <td>{{date['i']}}</td>
                            {%for late in date['lateArr']%}
                                {%for lates in late['lateDb']%}
                                <td>{{lates.time}} <input type="checkbox" id="checkbox" data-id="{{lates.id}}"></td>
                                {%endfor%}
                            {%endfor%}
                        </tr>
                        {%endfor%}                    
                </tbody>
            </table>
        </div>         
    </div>
</div>
