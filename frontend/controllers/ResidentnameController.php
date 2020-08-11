<?php
/**
 * Created by PhpStorm.
 * User: 2000
 * Date: 05.08.2020
 * Time: 8:34
 */

namespace frontend\controllers;


use app\models\residentname\Cases;
use app\models\residentname\City;
use app\models\residentname\Country;
use frontend\models\residentname\form\SearchPlace;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseInflector;
use yii\helpers\Url;
use yii\web\Controller;

class ResidentnameController extends Controller
{
    //детальная и страны и города
    public function actionPlaceView($url)
    {

        if ($url->route == 'city') {
            $place = City::find()
                ->where(['city.id' => $url->param])
                ->one();

            $this->view->params['breadcrumbs'] = [
                [
                    'label' => 'Города мира',
                    'url' => '/cities',
                ],
            ];

        }

        if ($url->route == 'country') {
            $place = Country::find()
                ->where(['country.id' => $url->param])
                ->one();

            $this->view->params['breadcrumbs'] = [
                [
                    'label' => 'Страны мира',
                    'url' => '/countries',
                ]
            ];
        }

//        echo "<pre>"; print_r(City::randomCityInRussia());die();

        //Title:
        $this->view->title = "Как называют жителей {$place->genitive->value} | Правильное название жителей города {$place->genitive->value}";

        $siteName = \Yii::$app->params['siteName'];

        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => "Как называют жителей {$place->genitive->value} | Официальные названия на сайте {$siteName}",
        ]);

        $this->view->params['breadcrumbs'][] = [
            'label' => $place->name,
        ];

        $cases = Cases::find()->asArray()->all();

        foreach ($place->nounses as $nouns) {
            $case = Cases::returnSelfById($nouns->cases_id);

            $nounsesGroup[$case['name_rus']][] = $nouns;
            $nounsesGroup[$case['name_rus']]['question_who'] = $case['question_who'];
            $nounsesGroup[$case['name_rus']]['question_what'] = $case['question_what'];
        }

        return $this->render('placeDetail', [
            'place' => $place,
            'nounsesGroup' => $nounsesGroup,
        ]);
    }

    //Названия жителей стран мира
    public function actionCountriesList()
    {
        $cacheName = 'CountriesList';
        $cache = \Yii::$app->cache;

        $places = $cache->getOrSet('CountriesList', function () {
            return $places = Country::find()->all();
        });


        //Title:

        $this->view->title = "Как называют жителей стран мира";


        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => "Как называют жителей стран мира",
        ]);


        return $this->render('placesList', [
            'places' => $places,
            'h1' => 'Названия жителей стран',
            'country' => true,
            'cacheName' => $cacheName . '_table',
            'cacheDisabled' => true,
        ]);
    }

    //Названия жителей городов
    public function actionCitiesList()
    {
        $cacheName = 'CitiesList';
        $cache = \Yii::$app->cache;

        $places = $cache->getOrSet($cacheName, function () {

            return $places = City::find()
                ->orderBy('name asc')
                ->all();;
        });


        $this->view->title = "Как называют жителей городов мира";

        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => "Как называют жителей городов мира",
        ]);

        $citySpell = \app\models\residentname\Url::find()
            ->where(['route' => 'search-city'])
            ->all();

        $cityGroupSpell = ArrayHelper::map($citySpell, 'param', 'url');

        return $this->render('placesList', [
            'places' => $places,
            'h1' => 'Названия жителей городов',
            'country' => false,
            'cacheName' => $cacheName . '_table',
            'cityGroupSpell' => $cityGroupSpell,
            'cacheDisabled' => true,
        ]);
    }

    public function actionSearchCityBySpell($url)
    {

        $cache = \Yii::$app->cache;
        $cacheName = 'CitiesList' . $url->param;


        $condition = $url->param . "%";

        $places = $cache->getOrSet($cacheName, function () use ($condition) {

            return $places = City::find()
                ->orderBy('name asc')
                ->where(['like', 'name', $condition, false])
                ->all();
        });

        $this->view->title = "Как называют жителей городов на букву " . $url->param;

        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => "Как называют жителей городов на букву " . $url->param
        ]);

        return $this->render('placesList', [
            'places' => $places,
            'h1' => "Как называют жителей городов на букву " . $url->param,
            'country' => false,
            'cacheName' => $cacheName,
            'cacheDisabled' => false,
        ]);
    }

    public function actionSearchCityBySpellForm()
    {
        $searchModel = new SearchPlace();
        $val = \Yii::$app->request->post('url');

        if ($searchModel->load(\Yii::$app->request->post()) && $searchModel->validate()) {
            $places = City::find()
                ->orderBy('name asc')
                ->where(['like', 'name', $searchModel->url . '%', false])
                ->all();
        }

        $this->view->title = "Поиск городов и стран на буквы \"" . $searchModel->url . "\"";

        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => "Поиск городов и стран на буквы \"" . $searchModel->url . "\"",
        ]);

        return $this->render('placesList', [
            'places' => $places,
            'h1' => "Поиск городов и стран на буквы \"" . $searchModel->url . "\"",
            'country' => false,
            'cacheDisabled' => false,
            'cacheName' => '',
        ]);
    }

}