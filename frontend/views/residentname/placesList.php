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
</style>

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
    <?php foreach ($places as $place): ?>
        <tr>
            <td class="text-muted small"><?= $count; ?></td>

            <?php if (!$country): ?>
                <td>
                    <a href="<?= $place->url->url; ?>"><?= $place->name; ?></a>
                </td>
            <?php endif; ?>

            <td>
                <?php if ($country): ?>
                    <img src="<?= $place->imgFlug; ?>"
                         alt="<?= $place->name; ?>"
                         width="16" height="16">
                    <a href="<?= $place->url->url; ?>"><?= $place->name; ?></a>
                <?php else: ?>
                    <img src="<?= $place->imgFlug; ?>"
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