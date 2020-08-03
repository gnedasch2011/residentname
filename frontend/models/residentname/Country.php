<?php

namespace app\models\residentname;

use Yii;

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

    public function getCountryDeclinesNouns()
    {
        return $this->hasMany(CountryDeclinesNouns::className(), ['country_id' => 'id']);
    }
}
