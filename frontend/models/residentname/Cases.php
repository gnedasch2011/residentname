<?php

namespace app\models\residentname;

use Yii;

/**
 * This is the model class for table "cases".
 *
 * @property int $id
 * @property string $name
 * @property string $name_rus
 */
class Cases extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cases';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','question_who','question_what', 'name_rus'], 'string', 'max' => 45],
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
            'name_rus' => 'Name Rus',
            'question_who' => 'question_who',
            'question_what' => 'question_what',
        ];
    }

    /**
     * @param $id
     * @return mixed|string
     */
    public static function returnNameById($id)
    {
        $cases = self::find()->asArray()->all();

        foreach ($cases as $case) {
            if ($id == $case['id']) {
                return $case['name_rus'];
            }
        }

        return '';
    }


    public static function returnSelfById($id)
    {
        $cases = self::find()->asArray()->all();

        foreach ($cases as $case) {
            if ($id == $case['id']) {
                return $case;
            }
        }

        return '';
    }
}
