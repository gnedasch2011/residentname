<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h1>Названия жителей <?= $place->genitive->value; ?> </h1>
</div>


<?php if ($country): ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php
        $countryInfoForMask = $place->countryInfoForMask;
        ?>

        Государство <?= $countryInfoForMask->country_name; ?>
        (<?= $countryInfoForMask->title_in_english; ?>) Полное наименование
        - <?= $countryInfoForMask->full_name; ?> находится в регионе
        <?= $countryInfoForMask->location; ?> (В части
        света <?= $countryInfoForMask->part_of_the_world; ?>) и имеет буквенные
        коды <?= $countryInfoForMask->character_code_2; ?>
        и <?= $countryInfoForMask->character_code_3; ?> (Код ISO
        - <?= $countryInfoForMask->iso_code; ?>).

        Столица государства <?= $countryInfoForMask->country_name; ?>
        - <?= $countryInfoForMask->capital; ?>, язык (языки), на котором говорят
        жители <?= $place->genitive->value; ?>: <?= $countryInfoForMask->language; ?>.
    </div>


<?php elseif (isset($place->country)): ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?= $place->nominative->value; ?> - город, расположенный
        во <?= $place->country->genitive->value; ?>. Официальные названия местных жителей и
        жительниц <?= $place->genitive->value; ?> в разных склонениях, числах и падежах:
    </div>


<?php endif; ?>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
            <h4><?= $place->man; ?></h4>
            <p>(<?= mb_strlen($place->man); ?> букв)</p>
            <img width="80px" src="\images\residentname\main\man.png" alt="">
            <p>мужчина</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
            <h4><?= $place->woman; ?></h4>
            <p>(<?= mb_strlen($place->woman); ?> букв)</p>
            <img width="100px" src="\images\residentname\main\woman.png" alt="">
            <p>женщина</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
            <h4><?= $place->townspeople; ?></h4>
            <p>(<?= mb_strlen($place->townspeople); ?> букв)</p>
            <img width="100px" src="\images\residentname\main\many_people.png" alt="">
            <p>горожане</p>
        </div>

        <?php if ($place->woman == ''): ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p>
                    Интересный факт, у жительниц, которые проживают в
                    городе <?= $place->nominative->value; ?> нет официального катойконима. Поэтому
                    самым
                    правильным вариантом названия будет: Жительница
                    города <?= $place->genitive->value; ?>
                </p>

            </div>
        <?php endif; ?>


    </div>
    <div class="tableScroll">
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
    </div>
    <br>
    <br>
    <br>


    <?php if (isset($place->cities) && !empty($place->cities)): ?>
        <h2>Города <?= $place->genitive->value; ?></h2>
        <div class="tableScroll">
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
                        <th scope="row"><a href="<?= $city->url->url; ?>"><?= $city->name; ?></a>
                        </th>
                        <td><?= $city->man; ?></td>
                        <td><?= $city->woman; ?></td>
                        <td><?= $city->townspeople; ?></td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>
    <?php endif; ?>

    <?php if ($place->isRussia()): ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3>Возможно, вам интересно узнать название жителей других городов России:</h3>

                <p>Как правильно называются жители
                    города <?= \app\models\residentname\City::renderRandomCityInRussiaLink(); ?>
                    ?</p>

                <p>Название жителей городов на букву <?= $place->firstLetterPlaceLink; ?>
                <p> Какой правильный катойконим
                    у <?= \app\models\residentname\City::renderRandomCityInRussiaLink(); ?> </p>
                <p>Название жителей <a href="/cities">всех городов России</a></p>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3> Хотите знать ещё больше?</h3>

                <p>Как правильно называются жители
                    <?= \app\models\residentname\City::renderRandomCityLink(); ?>?</p>

                <p> Правильное название проживающих в
                    городе <?= \app\models\residentname\City::renderRandomCityLink(); ?></p>
                <?php if ($place->firstLetterPlaceLink): ?>
                    <p> Список всех городов и их жителей на
                        букву <?= $place->firstLetterPlaceLink; ?></p>
                    <p>

                        Этнoxopoнимы (Этникoны) жителей <?= \app\models\residentname\Country::renderRandomPlaceLink(); ?>
                    </p>

                <?php endif; ?>

            </div>
        </div>

    <?php endif; ?>
</div>

<?php
echo common\widgets\micromark\MicromarkWidget::widget([
    'items' => $this->params['breadcrumbs'],
    'template' => 'breadcrubs',
]);
?>

<style>
    table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
    }

    table th {
        padding: 5px;
    }

    .liInline li {
        display: inline-block;
        padding-left: 5px;
        font-size: 1.3em;
    }

    .tableScroll {
        overflow-x: scroll;
    }
</style>