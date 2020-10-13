<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" sizes="57x57" href="/images/residentname/main/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/images/residentname/main/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/images/residentname/main/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/images/residentname/main/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/images/residentname/main/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/images/residentname/main/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/images/residentname/main/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/images/residentname/main/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/images/residentname/main/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/images/residentname/main/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/images/residentname/main/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/images/residentname/main/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/images/residentname/main/favicon-16x16.png">
	<link rel="manifest" href="/images/residentname/main/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/images/residentname/main/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
    <?php $this->registerCsrfMetaTags() ?>
    <?php
    $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => \yii\helpers\Url::to(['/images/residentname/main/favicon.ico'])]);//tets
    ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (m, e, t, r, i, k, a) {
            m[i] = m[i] || function () {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(66377239, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/66377239" style="position:absolute; left:-9999px;"
                  alt=""/></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->

    <?php $this->head() ?>

</head>
<body>

<!-- Классы navbar и navbar-default (базовые классы меню) -->
<!-- Классы navbar и navbar-default -->

<?php $this->beginBody() ?>
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand и toggle сгруппированы для лучшего отображения на мобильных дисплеях -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Названия жителей</a>
            </div>

            <!-- Соберите навигационные ссылки, формы, и другой контент для переключения -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class=""><a href="#">Планеты <span class="sr-only"></span></a>

                    <li class=""><a href="#">Континенты <span class="sr-only"></span></a>

                    <li class=""><a href="/countries">Страны <span class="sr-only">(current)</span></a>
                    </li>
                    <li><a href="/cities">Города мира</a></li>
                    <li><a href="/cities-rf">Регионы РФ</a></li>
                    <li><a href="#">Правила</a></li>
                </ul>
                <?php

                use yii\widgets\ActiveForm;

                $model = new \frontend\models\residentname\form\SearchPlace();
                $form = ActiveForm::begin([
                    'action' => '/residentname/search-city-by-spell-form',
                    'options' => ['class' => 'navbar-form navbar-left'],
                ]) ?>

                <div class="form-group">
                    <?= $form->field($model, 'url')
                        ->textInput([
                            'class' => 'form-control',
                            'placeholder' => 'Поиск',
                        ])->label('');
                    ?>
                </div>

                <?= Html::submitButton('Найти', ['class' => 'btn btn-default buttonCenter']) ?>

                <?php ActiveForm::end() ?>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <img style="
            background-size: contain;
            width: 100%;"
                 src="\images\residentname\main\advertising.jpg" alt="">
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php
            // $this is the view object currently being used
            echo Breadcrumbs::widget([
                'homeLink' => [
                    'label' => 'Названия жителей',
                    'url' => Yii::$app->homeUrl,
                    'title' => 'Названия жителей',
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]);
            ?>
            <?php
            if(isset($this->params['breadcrumbs'])){
                echo common\widgets\micromark\MicromarkWidget::widget([
                    'items' => $this->params['breadcrumbs'],
                    'template' => 'breadcrubs',
                ]);
            }

            ?>
        </div>

    </div>
    <div class="row">
        <?= $content ?>
    </div>
</div>

<div class="container-fluid bg-secondary">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- Yandex.RTB R-A-619913-1 -->
            <div id="yandex_rtb_R-A-619913-1"></div>
            <script type="text/javascript">
                (function (w, d, n, s, t) {
                    w[n] = w[n] || [];
                    w[n].push(function () {
                        Ya.Context.AdvManager.render({
                            blockId: "R-A-619913-1",
                            renderTo: "yandex_rtb_R-A-619913-1",
                            async: true
                        });
                    });
                    t = d.getElementsByTagName("script")[0];
                    s = d.createElement("script");
                    s.type = "text/javascript";
                    s.src = "//an.yandex.ru/system/context.js";
                    s.async = true;
                    t.parentNode.insertBefore(s, t);
                })(this, this.document, "yandexContextAsyncCallbacks");
            </script>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-dark text-white text-center">
            <a href="/">katoikonim.ru</a> © Катойконим - название жителей
            определенной страны, региона или города.

        </div>
    </div>
</div>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
<style>
    .buttonCenter {
        margin-bottom: 10px;
    }
</style>