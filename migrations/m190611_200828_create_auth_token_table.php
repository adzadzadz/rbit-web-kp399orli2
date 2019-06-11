<?php

use yii\db\Migration;
use yii\db\Schema;
use yii\base\Event;

/**
 * Handles the creation of table `{{%auth_token}}`.
 */
class m190611_200828_create_auth_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%auth_token}}', [
            'token' => $this->string(128)->notNull(),
            'user_id' => Schema::TYPE_BIGINT . ' NOT NULL',
            'verify_ip' => $this->boolean()->defaultValue(false),
            
            // @link http://stackoverflow.com/a/20473371
            'user_ip' => $this->string(46),
            
            // @link http://stackoverflow.com/a/20746656
            'user_agent' => $this->text(),
            
            'frozen_expire'  => $this->boolean()->defaultValue(true),
            
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 5',
            'created_at' => $this->dateTime(),
            'expired_at'  => $this->dateTime(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%auth_token}}');
    }
}
