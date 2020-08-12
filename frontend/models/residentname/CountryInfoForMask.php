<?php

namespace app\models\residentname;

use Yii;

/**
 * This is the model class for table "country_info_for_mask".
 *
 * @property int $id
 * @property int $country_id
 * @property string $part_of_the_world
 * @property string $capital
 * @property string $language
 * @property string $country_name
 * @property string $character_code_2
 * @property string $character_code_3
 * @property string $iso_code
 * @property string $full_name
 * @property string $title_in_english
 * @property string $location
 */
class CountryInfoForMask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country_info_for_mask';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id'], 'integer'],
            [['part_of_the_world', 'capital', 'language', 'country_name', 'character_code_2', 'character_code_3', 'iso_code', 'full_name', 'title_in_english', 'location'], 'string', 'max' => 100],
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
            'part_of_the_world' => 'Part Of The World',
            'capital' => 'Capital',
            'language' => 'Language',
            'country_name' => 'Country Name',
            'character_code_2' => 'Character Code 2',
            'character_code_3' => 'Character Code 3',
            'iso_code' => 'Iso Code',
            'full_name' => 'Full Name',
            'title_in_english' => 'Title In English',
            'location' => 'Location',
        ];
    }
}
