<?php
$country = true;
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php if (isset($h1)): ?>
        <h1><?= $h1; ?></h1>
    <?php endif; ?>
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
    <h2>Самые популярные названия жителей стран Мира</h2>
    <?php if ($this->beginCache('placesPopularCountries', [
        'enabled' => $cacheEnabled,
    ])): ?>
        <div class="tableScroll">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <?php if (!$country): ?>
                        <th>Название</th>
                    <?php endif; ?>
                    <th>Страна</th>
                    <th>Мужчины</th>
                    <th>Женщины</th>
                    <th>Граждане</th>
                </tr>

                <tbody>
                <?php
                $count = 1;
                ?>
                <?php foreach ($placesPopularCountries as $place): ?>
                    <tr>
                        <td class="text-muted small"><?= $count; ?></td>

                        <?php if (!$country && isset($place->url->url)): ?>
                            <td>
                                <a href="<?= $place->url->url; ?>"><?= $place->name; ?></a>
                            </td>
                        <?php endif; ?>

                        <td>
                            <?php if ($country): ?>
                                <img src="<?= $place->imgFlug; ?>"
                                     alt="<?= $place->name; ?>"
                                     width="16" height="16">
                                <a href="/<?= $place->url->url; ?>"><?= $place->name; ?></a>
                            <?php else: ?>
                                <img src="/<?= $place->imgFlug; ?>"
                                     alt="<?= $place->country->name; ?>"
                                     width="16" height="16">
                                <a href="<?= $place->country->url->url; ?>"><?= $place->country->name; ?></a>
                            <?php endif; ?>

                        </td>
                        <td><?= $place->man; ?></td>
                        <td><?= $place->woman; ?></td>
                        <td><?= $place->townspeople; ?></td>
                    </tr>
                    <?php
                    $count++;
                    ?>
                <?php endforeach; ?>
                </tbody>
                </thead>
            </table>
        </div>
        <?php $this->endCache(); ?>

    <?php endif; ?>
</div>

<?php
$country = false;
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php if (isset($h1)): ?>
        <h1><?= $h1; ?></h1>
    <?php endif; ?>
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
    <h2>Самые популярные названия жителей Городов России и Мира</h2>
    <?php if ($this->beginCache('placesPopularCities', [
        'enabled' => $cacheEnabled,
    ])): ?>
        <div class="tableScroll">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <?php if (!$country): ?>
                        <th>Город</th>
                    <?php endif; ?>
                    <th>Страна</th>
                    <th>Мужчины</th>
                    <th>Женщины</th>
                    <th>Граждане</th>
                </tr>

                <tbody>
                <?php
                $count = 1;
                ?>
                <?php foreach ($placesPopularCities as $place): ?>
                    <tr>
                        <td class="text-muted small"><?= $count; ?></td>

                        <?php if (!$country && isset($place->url->url)): ?>
                            <td>
                                <a href="<?= $place->url->url; ?>"><?= $place->name; ?></a>
                            </td>
                        <?php endif; ?>

                        <td>
                            <?php if ($country): ?>
                                <img src="<?= $place->imgFlug; ?>"
                                     alt="<?= $place->name; ?>"
                                     width="16" height="16">
                                <a href="/<?= $place->url->url; ?>"><?= $place->name; ?></a>
                            <?php else: ?>
                                <img src="/<?= $place->imgFlug; ?>"
                                     alt="<?= $place->country->name; ?>"
                                     width="16" height="16">
                                <a href="<?= $place->country->url->url; ?>"><?= $place->country->name; ?></a>
                            <?php endif; ?>

                        </td>
                        <td><?= $place->man; ?></td>
                        <td><?= $place->woman; ?></td>
                        <td><?= $place->townspeople; ?></td>
                    </tr>
                    <?php
                    $count++;
                    ?>
                <?php endforeach; ?>
                </tbody>
                </thead>
            </table>
        </div>
        <?php $this->endCache(); ?>

    <?php endif; ?>
</div>



