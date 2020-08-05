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
use yii\web\Controller;

class ResidentnameController extends Controller
{
    public function actionPlaceView($url)
    {
        if ($url->route == 'city') {
            $place = City::find()
                ->where(['city.id' => $url->param])
                ->one();
        }

        if ($url->route == 'country') {
            $place = Country::find()
                ->where(['country.id' => $url->param])
                ->one();
        }

        $nounsesGroup = [];

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
}