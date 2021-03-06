<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%car}}".
 *
 * @property int $id
 * @property string $name
 * @property string $model
 * @property string $notes
 */
class Car extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%car}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'model', 'notes'], 'string', 'max' => 255],
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
            'model' => 'Model',
            'notes' => 'Notes',
        ];
    }
}
