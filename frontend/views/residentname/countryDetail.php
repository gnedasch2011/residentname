<!--<h1>Жители --><? //= $country->genitive->value; ?><!-- </h1>-->

<table class="table">
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

<!--Именительный	что?	Белиз	кто?	белизец	белизка	белизцы?-->