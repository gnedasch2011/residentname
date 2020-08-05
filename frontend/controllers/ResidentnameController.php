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
use yii\helpers\Url;
use yii\web\Controller;

class ResidentnameController extends Controller
{
    public function actionPlaceView($url)
    {

        if ($url->route == 'city') {
            $place = City::find()
                ->where(['city.id' => $url->param])
                ->one();

            $this->view->params['breadcrumbs'] = [
                [
                    'label' => 'Города мира',
                    'url' => 'cities',
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
                    'url' => 'countries',
                ]
            ];
        }


        //Title:

        $this->view->title = "Как называют жителей {$place->genitive->value} | Правильное название жителей города {$place->genitive->value}";

        $siteName = \Yii::$app->params['siteName'];

        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => "Как называют жителей {$place->genitive->value} | Официальные названия на сайте {$siteName}",
        ]);

        $this->view->params['breadcrumbs'][] = [
            'label' => $place->name
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
        $countries = Country::find()->all();

        return $this->render('countriesList', [
            'countries' => $countries,
        ]);
    }

    //Названия жителей городов
    public function actionCitiesList()
    {

        $countries = City::find()
            ->orderBy('name asc')
            ->all();

        return $this->render('citiesList', [
            'countries' => $countries,
            'h1' => 'Названия жителей городов',
        ]);
    }
}