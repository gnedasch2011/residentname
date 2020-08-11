<?php

namespace app\models\residentname;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property int $country_id
 * @property string $name
 * @property string $man
 * @property string $woman
 * @property string $townspeople
 * @property string $link
 */
class City extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id'], 'integer'],
            [['name', 'man', 'woman', 'townspeople', 'link'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'name' => 'Name',
            'man' => 'Man',
            'woman' => 'Woman',
            'townspeople' => 'Townspeople',
            'link' => 'Link',
        ];
    }


    public function getNounses()
    {
        return $this->hasMany(NounseValue::className(), ['item_id' => 'id'])
            ->where([
                'kinds_of_nouns_id' => 2
            ]);
    }

    public function getUrl()
    {
        return $this->hasOne(Url::className(), ['param' => 'id'])
            ->where(['route' => 'city']);
    }

    //Родительный падеж
    public function getGenitive()
    {
        return $this->hasOne(NounseValue::className(), ['item_id' => 'id'])
            ->where([
                'kinds_of_nouns_id' => 2,
                'declines_nouns_id' => 1,
                'cases_id' => 2,
            ]);
    }

    //Именительный падеж
    public function getNominative()
    {
        return $this->hasOne(NounseValue::className(), ['item_id' => 'id'])
            ->where([
                'kinds_of_nouns_id' => 2,
                'declines_nouns_id' => 1,
                'cases_id' => 1,
            ]);
    }


    public function getImgFlug()
    {
        return $this->country->imgFlug;

    }

    public function getCountryName()
    {
        return $this->country->name;
    }

    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }


}
