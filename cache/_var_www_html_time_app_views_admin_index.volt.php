<?= $this->getContent() ?>
<div class="container">
    <div class="page-header">
        <h1>Admin panel</h1>
    </div>
    <p></p>
      <button type="button" class="btn btn-light" id="show_report">Report by month</button>
      <button type="button" class="btn btn-light" id="hide_report">Hide report</button>
      <div id="report"><?= $this->partial('partials/admin') ?></div>
</div>