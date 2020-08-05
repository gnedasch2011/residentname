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

<table>
    <thead>
    <tr>
        <th>#</th>
        <th colspan="2">Страна</th>
        <th>Мужчины</th>
        <th>Женщины</th>
        <th>Граждане</th>
    </tr>

    <tbody>
    <?php
    $count = 1;
    ?>
    <?php foreach ($countries as $country): ?>
        <tr>
            <td class="text-muted small"><?= $count; ?></td>
            <td>
                <img src="/images/residentname/flags/<?= $country->img; ?>" alt="<?= $country->name; ?>"
                     width="16" height="16">
                AB
            </td>
            <td>
                <a href="<?= $country->url->url; ?>"><?= $country->name; ?></a>
            </td>
            <td><?= $country->man ;?></td>
            <td><?= $country->woman ;?></td>
            <td><?= $country->townspeople ;?></td>
        </tr>
        <?php
        $count++;
        ?>
    <?php endforeach; ?>


    </tbody>

    </thead>
</table>