<h4 class="text-center">    <code>Guest</code></h4>

<p><?= $this->tag->linkTo(['user/index', 'Log in']) ?>
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
    <h3><?= $todayMonth ?></h3>
</div>

<div class="ml-5">
    <p>Amount of days in month: <code><?= $totalDays ?> days</code></p>
    <p>Amount of working days in month: <code><?= $totalWorkingDays ?> days</code></p>
</div>

<table class="table">
    <thead>
        <tr class="showOnlyToday">
            <th scope="col">Weekday</th>
            <?php foreach ($users as $user) { ?>
            <th scope="col"><?= $user->name ?></th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $data) { ?>
            <?php if ($today == $data['number']) { ?>
                <tr class="showOnlyToday">
            <?php } else { ?>
                <tr>
            <?php } ?>
            
            <?php if ($data['day'] == 0 || $data['day'] == 6 || $data['notWork'] != 0) { ?>
                <th class="rest"><p><?= $data['weekday'] ?></p> <p class="text-numb"><?= $data['number'] ?></p></th>
                <?php } else { ?>
                <th><p><?= $data['weekday'] ?></p> <p class="text-numb"><?= $data['number'] ?></p></th>


                <?php foreach ($data['tracking'] as $start) { ?>
                    <td>
                    <?php foreach ($start['trackingByUser'] as $byUser) { ?>
                         <p><span><?= $byUser->start_time ?></span> <span>-</span>
                        <span><?= $byUser->end_time ?></span></p>
                    <?php } ?>
                    <?php if ($start['totalTimeDay']['hour'] == 0 && $start['totalTimeDay']['minute'] == 0) { ?>
                    <?php } else { ?>
                        <p class="mt-5">Total: <?= $start['totalTimeDay']['hour'] ?>:<?= $start['totalTimeDay']['minute'] ?> </p>
                    <?php } ?>                    
                    <?php if ($start['lessTimeDay']['hour'] > -1) { ?>
                        <p class="text-center"><code>   Less:  <?= $start['lessTimeDay']['hour'] ?>:<?= $start['lessTimeDay']['minute'] ?> </code></p>
                    <?php } ?>
                    </td>
                <?php } ?>

            <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>