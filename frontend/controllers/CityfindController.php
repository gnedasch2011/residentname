<?php
/**
 * Created by PhpStorm.
 * User: 2000
 * Date: 13.08.2020
 * Time: 11:06
 */

namespace frontend\controllers;

use yii\rest\ActiveController;

class CityfindController extends ActiveController
{

    ///Параметр пост, или по букве вернуть массив

    public $modelClass = 'app\models\residentname\City';

    public function actionIndex()
    {
        echo "<pre>";
        print_r('fdf');
        die();
        return new ActiveDataProvider([
            'query' => Post::find(),
        ]);
    }

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];


    public function fields()
    {
        return [
            'country_id',
            'fullName' => function ($model) {
                return $model->first_name . ' ' . $model->last_name;
            },
        ];
    }


    public function extraFields()
    {
        return ['country_id'];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ]
            ]
        ];
    }

}


