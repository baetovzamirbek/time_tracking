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
    <p>You have: <code><?= $monthTotalTime['hour'] ?>:<?= $monthTotalTime['minute'] ?></code></p>
    <p>You've lated: <code><?= $countLateTime ?> time</code></p>
    <p></p>
</div>

<table class="table">
    <thead>
        <tr class="showOnlyToday">
            <th scope="col">WeekDay</th>
            <th scope="col">Day</th>
            <th scope="col">Start</th>
            <th scope="col">Stop</th>
            <th scope="col">#</th>
        </tr>
    </thead>
    <tbody> 
        <?php foreach ($data as $data) { ?>
            <?php if ($today == $data['number']) { ?>
                <tr class="showOnlyToday">
            <?php } else { ?>
                <tr>
            <?php } ?>

                <?php if ($data['day'] == 0 || $data['day'] == 6) { ?>
                    <th class="rest"><?= $data['weekday'] ?></th>
                    <td class="rest"><?= $data['number'] ?></td>
                    <td></td>
                    <td></td>
                <?php } else { ?>
                    <th><?= $data['weekday'] ?></th>
                    <td><?= $data['number'] ?></td>
                    <td>
                    <?php foreach ($data['tracking'] as $start) { ?>
                        <p><?= $start->start_time ?></p>
                    <?php } ?>
                    <?php if ($today == $data['number']) { ?>
                        <p id="start_text"></p>
                    <?php } ?>
                    </td>
                <td>
                    <?php foreach ($data['tracking'] as $start) { ?>
                        <p><?= $start->end_time ?></p>
                    <?php } ?>
                    <?php if ($today == $data['number']) { ?>
                        <p id="stop_text"></p>
                    <?php } ?>
                </td>
                <td>
                    <?php if ($data['totalTimeDay']['hour'] == 0 && $data['totalTimeDay']['minute'] == 0) { ?>
                    <?php } else { ?>
                        <p>Total: <?= $data['totalTimeDay']['hour'] ?>:<?= $data['totalTimeDay']['minute'] ?> </p>
                    <?php } ?>

                    <?php if ($data['lessTime']['hour'] > -1) { ?>
                        <p><code>   Less:  <?= $data['lessTime']['hour'] ?>:<?= $data['lessTime']['minute'] ?> </code></p>
                    <?php } ?>
                    
                    <?php if ($today == $data['number'] && $numTodayMonth == $numSelectMonth) { ?>
                    <?php if ($data['totalTimeDay']['stopButton'] == 1) { ?>
                    <button type="button" class="btn btn-danger" id="start_button" style="display:none;">Start</button>
                    <button type="button" class="btn btn-danger" id="stop_button">Stop</button>
                    <?php } else { ?>
                    <button type="button" class="btn btn-danger" id="start_button">Start</button>
                    <button type="button" class="btn btn-danger" id="stop_button" style="display:none;">Stop</button>
                    <?php } ?>
                    <?php } ?>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>   
    </tbody>
</table>