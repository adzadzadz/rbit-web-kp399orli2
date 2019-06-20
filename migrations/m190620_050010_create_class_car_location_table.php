<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%class_car_location}}`.
 */
class m190620_050010_create_class_car_location_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%class_car_location}}', [
            'id' => $this->primaryKey(),
            'trainer_id' => $this->integer(),
            'student_id' => $this->integer(),
            'class_id'   => $this->integer(),
            'car_id'     => $this->integer(),
            'locations_id' => $this->integer(),

            'status'     => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%class_car_location}}');
    }
}
