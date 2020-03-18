
{{ content() }}
<div class="container">
    <div class="page-header">
        <h1>Time tracking tool</h1>
    </div>
    <p>{{ link_to('user/index', 'Log in') }}
    {{ link_to('user/logout', 'Log out') }}
    {{ link_to('user/change', 'Change password') }}
    </p>
    <button type="button" class="btn btn-primary" id="start_button">Start</button>
    <button type="button" class="btn btn-danger" id="stop_button" style="display:none;">Stop</button>
    <p></p>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Day</th>
            <th scope="col">Start</th>
            <th scope="col">Stop</th>
          </tr>
        </thead>
        <tbody>            
            <tr>
                <th>Thursday</th>
                <td>{{ date}}</td>
                <td>
                    {%for data in tracking%}
                    <p>{{ data.start_time }}</p>
                    {%endfor%}
                    <p id="start_text"></p>
                </td>
                <td>
                    {%for data in tracking%}
                    <p>{{ data.end_time }}</p>
                    {%endfor%}
                    <p id="stop_text"></p>
                </td>
            </tr>            
            
            <tr>
                <td colspan="6" class="text-center"><h4>Total time: <code>{{ total['hour']}} : {{ total['minute']}}</h4> </code> 
                </td>
            </tr>
        </tbody>
      </table>

      <button type="button" class="btn btn-secondary" id="show_report">Report by month</button>
      <button type="button" class="btn btn-secondary" id="hide_report">Hide report</button>
      <div id="report">{{ partial('partials/admin') }}</div>
</div>