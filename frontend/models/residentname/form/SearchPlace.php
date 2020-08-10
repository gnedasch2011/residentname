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
    public $name;

    public function rules()
    {
        return [
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'required'],
            ['name', 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
        ];
    }
}