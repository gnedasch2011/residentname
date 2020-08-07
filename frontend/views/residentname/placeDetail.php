<h1>Название жителей <?= $place->genitive->value; ?> </h1>

<?php /*?>

<p>Страна Австрия имеет полное официальное название Австрийская Республика и буквенные коды AT и
    AUT. Официальные названия граждан <?= $place->genitive->value; ?>:</p>
<?php */?>
<div class="row">

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
        <h4><?= $place->man ;?></h4>
        <p>(<?= mb_strlen($place->man) ;?> букв)</p>
        <img width="80px" src="images\residentname\main\man.png" alt="">
        <p>мужчина</p>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
        <h4><?= $place->woman ;?></h4>
        <p>(<?= mb_strlen($place->woman) ;?> букв)</p>
        <img width="100px" src="images\residentname\main\woman.png" alt="">
        <p>женщина</p>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
        <h4><?= $place->townspeople ;?></h4>
        <p>(<?= mb_strlen($place->townspeople) ;?> букв)</p>
        <img width="100px" src="images\residentname\main\many_people.png" alt="">
        <p>горожане</p>
    </div>
</div>

<table class="table table-striped">
    <tr>
        <th>Падеж</th>
        <th>Вопрос</th>
        <th>Страна</th>
        <th>Вопрос</th>
        <th>Мужчина</th>
        <th>Женщина</th>
        <th>Жители</th>
    </tr>
    <tbody>

    <?php foreach ($nounsesGroup as $caseName => $casesGroup): ?>
        <tr>
            <th scope="row"><?= $caseName; ?></th>
            <td><?= $casesGroup['question_what']; ?></td>
            <td><?= $casesGroup[0]->value; ?></td>
            <td><?= $casesGroup['question_who']; ?></td>
            <td><?= $casesGroup[1]->value; ?></td>
            <td><?= $casesGroup[2]->value; ?></td>
            <td><?= $casesGroup[3]->value; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<br>
<br>
<br>

<?php if (isset($place->cities) && !empty($place->cities)): ?>
    <h2>Города <?= $place->genitive->value; ?></h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Город</th>
            <th>Мужчины</th>
            <th>Женщины</th>
            <th>Граждане</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($place->cities as $city): ?>
            <tr>
                <th scope="row"><a href="<?= $city->url->url; ?>"><?= $city->name; ?></a></th>
                <td><?= $city->man; ?></td>
                <td><?= $city->woman; ?></td>
                <td><?= $city->townspeople; ?></td>
            </tr>
        <?php endforeach; ?>

    </table>

<?php endif; ?>