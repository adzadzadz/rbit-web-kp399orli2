<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%car}}`.
 */
class m190620_045102_create_car_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car}}', [
            'id' => $this->primaryKey(),
            'name'  => $this->string(),
            'model' => $this->string(),
            'notes' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%car}}');
    }
}
