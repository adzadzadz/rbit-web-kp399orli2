<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%class_car_location}}".
 *
 * @property int $id
 * @property int $trainer_id
 * @property int $student_id
 * @property int $class_id
 * @property int $car_id
 * @property int $locations_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class ClassCarLocation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%class_car_location}}';
    }

    public function behaviors()
{
    return [
        TimestampBehavior::className(),
    ];
}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trainer_id', 'student_id', 'class_id', 'car_id', 'locations_id'], 'required'],
            [['trainer_id', 'student_id', 'class_id', 'car_id', 'locations_id', 'status', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trainer_id' => 'Trainer ID',
            'student_id' => 'Student ID',
            'class_id' => 'Class ID',
            'car_id' => 'Car ID',
            'locations_id' => 'Locations ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getClass()
    {
        return $this->hasOne(\app\models\TesterClass::className(), ['id' => 'class_id']);
    }
    
    public function getCar()
    {
        return $this->hasOne(\app\models\Car::className(), ['id' => 'car_id']);
    }

    public function getstudent()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'student_id']);
    }

    public function getTrainer()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'trainer_id']);
    }

    public function getLocs()
    {
        return $this->hasOne(\app\models\Locations::className(), ['id' => 'locations_id']);
    }
}
