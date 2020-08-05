<h1>Название жителей <?= $place->genitive->value; ?> </h1>
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