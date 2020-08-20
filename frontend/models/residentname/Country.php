<?php

namespace app\models\residentname;

use yii\helpers\Html;

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
    const ID_RUSSIA = 138;

    public function isRussia()
    {
        if (isset($this->country->id) && $this->country->id == self::ID_RUSSIA) {
            return true;
        }
        return false;
    }

    public function getFirstLetterPlaceLink()
    {
        $firstLetter = mb_substr($this->name, 0, 1);

        $url = Url::find()
            ->where([
                'route' => 'search-city',
                'param' => $firstLetter,
            ])
            ->one();

        if ($url) {

            return Html::a($firstLetter, '/' . $url->url);

        }

        return false;
    }
    
    
     public function getCountryInfoForMask()
         {
             return $this->hasOne(CountryInfoForMask::className(), ['country_id' => 'id']);
         }


    public static function randomPlace()
    {
        $place = self::find()
            ->orderBy('rand()')
            ->limit(1)
            ->one();

        if ($place) {
            return $place;
        }

        return false;
    }

    public static function renderHTMLLink($place)
    {
        $link = Html::a($place->genitive->value, '/' . $place->url->url);
        return $link;
    }

    public static function renderRandomPlaceLink()
    {
        $place = self::randomPlace();

        return self::renderHTMLLink($place);
    }


}
