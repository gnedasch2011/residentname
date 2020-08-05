<?php

namespace app\models\residentname;

use Yii;

/**
 * This is the model class for table "nounse_value".
 *
 * @property int $id
 * @property int $item_id
 * @property int $declines_nouns_id
 * @property int $cases_id
 * @property string $value
 * @property int $kinds_of_nouns_id
 */
class NounseValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nounse_value';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'declines_nouns_id', 'cases_id', 'kinds_of_nouns_id'], 'integer'],
            [['value'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Item ID',
            'declines_nouns_id' => 'Declines Nouns ID',
            'cases_id' => 'Cases ID',
            'value' => 'Value',
            'kinds_of_nouns_id' => 'Kinds Of Nouns ID',
        ];
    }
}
