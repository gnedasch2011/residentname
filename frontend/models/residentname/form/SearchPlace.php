<?php
/**
 * Created by PhpStorm.
 * User: 2000
 * Date: 10.08.2020
 * Time: 8:34
 */

namespace frontend\models\residentname\form;

use yii\base\Model;

class SearchPlace extends Model
{
    public $url;

    public function rules()
    {
        return [
            ['url', 'filter', 'filter' => 'trim'],
            ['url', 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'url' => 'url',
        ];
    }
}