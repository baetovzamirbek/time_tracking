<?= $this->getContent() ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h4 class="text-center mt-5">Страница опозданий</h4>
        </div>
        <div class="col-12 mt-5">
            <h5>Начало рабочего дня</h5>
            <input type="time" id="typeTime" name="appt" value="<?= $startTime ?>">
            <button type="button" class="btn btn-secondary" id="changeLateTime">Изменить</button>
        </div> 
        <div class="col-12 mt-5">
            <table class="table">
                <thead>
                    <tr class="showOnlyToday trst">
                        <th>Date</th>
                        <?php foreach ($users as $user) { ?>
                            <th scope="col"><?= $user->name ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <tr class="trst">
                        <?php foreach ($users as $user) { ?>
                            <td class="td<?= $user->id ?>"></td>
                        <?php } ?>
                    </tr>

                        <?php foreach ($dates as $date) { ?>
                        <tr class="trst">
                            <td><?= $date['i'] ?></td>
                            <?php foreach ($date['lateArr'] as $late) { ?>
                                <?php foreach ($late['lateDb'] as $lates) { ?>
                                <td><?= $lates->time ?> <input type="checkbox" id="checkbox" data-id="<?= $lates->id ?>"></td>
                                <?php } ?>
                            <?php } ?>
                        </tr>
                        <?php } ?>                    
                </tbody>
            </table>
        </div>         
    </div>
</div>
