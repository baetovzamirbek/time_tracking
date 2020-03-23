
{{ content() }}
<div class="container">
    <div class="page-header">
        <h1>Time tracking tool</h1>
    </div>

    <p></p>
      <button type="button" class="btn btn-light" id="show_report">Report by month</button>
      <button type="button" class="btn btn-light" id="hide_report">Hide report</button>
      <div id="report">{{partial('partials/user')}}</div>
</div>