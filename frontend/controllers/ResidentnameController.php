<?php
/**
 * Created by PhpStorm.
 * User: 2000
 * Date: 05.08.2020
 * Time: 8:34
 */

namespace frontend\controllers;


use app\models\residentname\Cases;
use app\models\residentname\Country;
use yii\web\Controller;

class ResidentnameController extends Controller
{
    public function actionCountry($url)
    {
        $country = Country::find()
            ->where(['country.id' => $url->id])
            ->one();

        $nounsesGroup = [];
        $cases = Cases::find()->asArray()->all();

        foreach ($country->nounses as $nouns) {
            $case = Cases::returnSelfById($nouns->cases_id);

            $nounsesGroup[$case['name_rus']][] = $nouns;
            $nounsesGroup[$case['name_rus']]['question_who']= $case['question_who'];
            $nounsesGroup[$case['name_rus']]['question_what']= $case['question_what'];
        }

        return $this->render('countryDetail', [
            'country' => $country,
            'nounsesGroup' => $nounsesGroup,
        ]);

//        echo "<pre>";
//        print_r($country);
//        die();
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