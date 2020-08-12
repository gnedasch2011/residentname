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
use Yii;

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

        $siteName = \Yii::$app->request->hostInfo;

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

    //Названия жителей городов РФ
    public function actionCitiesRfList()
    {
        $cacheName = 'CitiesListRf';
        $cache = \Yii::$app->cache;

        $places = $cache->getOrSet($cacheName, function () {

            return $places = City::find()
                ->orderBy('name asc')
                ->where(['country_id' => 138])
                ->all();

        });


        $this->view->title = "Как называют жителей городов Российской Федерации";

        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => "Как называют жителей городов Российской Федерации",
        ]);


        return $this->render('placesList', [
            'places' => $places,
            'h1' => 'Как называют жителей городов Российской Федерации',
            'country' => false,
            'cacheName' => $cacheName . '_table',
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

        $this->view->title = "Города на букву {$url->param} | Все города России и Мира на букву {$url->param} | Катойконим.РУ";

        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => "Города на букву " . $url->param
        ]);

        return $this->render('placesList', [
            'places' => $places,
            'h1' => "Города на букву " . $url->param,
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


    public function actionMainPage()
    {
        $cacheName = 'mainList';
        $cache = \Yii::$app->cache;

        $placesPopularCities = $cache->getOrSet('mainList_placesPopularCities', function () {

            return $placesPopularCities = City::find()
                ->where(['id' => [22, 26, 101, 111, 154, 193, 210, 279, 347, 404, 415, 436, 442, 449, 452, 463, 464, 471, 473, 477, 479, 486, 490, 502, 528, 530, 533, 535, 537, 543, 553, 564, 573, 578, 580, 597, 614, 650, 655, 660, 672, 688, 707, 711, 712, 713, 717, 719, 739, 746, 748, 750, 751, 752, 753, 761, 769, 777, 780, 785, 787, 790, 795, 796, 800, 802, 804, 805, 807, 816, 817, 826, 828, 865, 924, 958, 976, 1000, 1016]])
                ->orderBy('name asc')
                ->all();
        });

        $placesPopularCountries = $cache->getOrSet('mainList_placesPopularCountries', function () {

            return $placesPopularCountries = Country::find()
                ->where(['id' => [2, 18, 22, 33, 34, 47, 49, 51, 59, 60, 63, 71, 74, 77, 84, 85, 89, 92, 97, 102, 115, 122, 123, 125, 126, 127, 135, 138, 142, 145, 164, 172, 179, 185, 187, 188, 189, 198]])
                ->orderBy('name asc')
                ->all();
        });

        $this->view->title = "Как называют жителей городов мира";

        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => "Как называют жителей городов мира",
        ]);


        return $this->render('index', [
            'h1' => 'Катойконимы - названия жителей городов',
            'placesPopularCities' => $placesPopularCities,
            'placesPopularCountries' => $placesPopularCountries,
            'country' => false,
            'cacheName' => $cacheName . '_table',
            'cacheEnabled' => false,
        ]);
    }

    public function actionSitemapXml()
    {

        $urls = [];

        foreach (\app\models\residentname\Url::find()->all() as $url) {
            $urls[] = array(
                'loc' => $url->url,
                'changefreq' => 'weekly',
                'priority' => 0.9,
            );
        }

        $urls = array_merge([
            [
                'loc' => '/',
                'changefreq' => 'weekly',
                'priority' => 1,
            ]
        ], $urls);


        if (!$xml_sitemap = Yii::$app->cache->get('sitemap')) {
            $xml_sitemap = $this->renderPartial('sitemap', array(
                'host' => \Yii::$app->request->hostInfo,
                'urls' => $urls,
            ));
            Yii::$app->cache->set('sitemap', $xml_sitemap, 60 * 60 * 12); // кэшируем результат на 12 ч
        }


        \Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'text/xml');

        return $xml_sitemap;
    }
}