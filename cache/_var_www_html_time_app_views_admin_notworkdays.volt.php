<?= $this->getContent() ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Нерабочие дни</h2>
            <table class="table">
                <thead class="thead-dark">
                  <tr class="trst">
                    <th scope="col">Дата</th>
                    <th scope="col">Повтор</th>
                    <th scope="col">Удалить</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($notWork as $data) { ?>
                  <tr class="trst">
                    <td><?= $data->date ?></td>
                    <td>
                        <?php if ($data->every_year == 1) { ?>
                        <p><?= $user->name ?> <input type="checkbox" id="every_year" checked="checked" data-id="<?= $data->id ?>"></p>
                        <?php } else { ?>
                        <p><?= $user->name ?> <input type="checkbox" id="every_year" data-id="<?= $data->id ?>"></p>
                        <?php } ?>
                    </td>
                    <td><p><?= $user->name ?> <input type="checkbox" id="delete_notWork" data-id="<?= $data->id ?>"></p></td>
                  </tr>
                  <?php } ?>
                </tbody>
            </table>
        <div class="col mt-5">
          <h4>Добавление не рабочего дня</h4>
          <p><label for="fname">Дата:</label>
          <input type="date" id="fname" name="fname" data-date-format="YYYY MM DD " value="2020-01-01"></p>
          <p><label for="fname">Повтор:</label><input type="checkbox" id="checkNotWork">
          </p>
          <p><button type="button" class="btn btn-dark" id="btnNotWork">Добавить</button></p>
        </div>
    </div>
</div>
