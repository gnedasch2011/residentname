<?php

namespace app\models\residentname;

/**
 * This is the model class for table "country".
 *
 * @property int $id
 * @property string $name
 * @property string $man
 * @property string $woman
 * @property string $townspeople
 * @property string $img
 * @property string $index_name
 * @property string $link
 */
class Country extends \yii\db\ActiveRecord
{

    const IMG_PATH_FLUG = 'images/residentname/flags/';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'man', 'woman', 'townspeople', 'index_name', 'link'], 'string', 'max' => 45],
            [['img'], 'string', 'max' => 450],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'man' => 'Man',
            'woman' => 'Woman',
            'townspeople' => 'Townspeople',
            'img' => 'Img',
            'index_name' => 'Index Name',
            'link' => 'Link',
        ];
    }

    public function getNounses()
    {
        return $this->hasMany(NounseValue::className(), ['item_id' => 'id'])
            ->where([
                'kinds_of_nouns_id' => 1
            ]);
    }

    public function getUrl()
    {
        return $this->hasOne(Url::className(), ['param' => 'id'])
            ->where(['route' => 'country']);
    }

    //Родительный падеж
    public function getGenitive()
    {
        return $this->hasOne(NounseValue::className(), ['item_id' => 'id'])
            ->where([
                'kinds_of_nouns_id' => 1,
                'declines_nouns_id' => 1,
                'cases_id' => 2,
            ]);
    }

    public function getCities()
    {
        return $this->hasMany(City::className(), ['country_id' => 'id']);
    }

    public function getImgFlug()
    {
        return self::IMG_PATH_FLUG . $this->img;
    }

    public function getCountryName()
    {
        return $this->name;
    }

}
