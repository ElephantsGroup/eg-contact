<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contact_us`.
 */
class m161207_052503_create_contact_us_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%eg_contact_us}}', [
            'id' => $this->primaryKey(),
            'ip' => $this->string(32),
            'user_id' => $this->integer(11),
            'name' => $this->string(64)->notNull(),
            'email' => $this->string(128)->notNull(),
            'subject' => $this->string(128),
            'description' => $this->text(),
            'sort_order' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'update_time' => $this->timestamp()->notNull(),
            'creation_time' => $this->timestamp()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%eg_contact_us}}');
    }
}
