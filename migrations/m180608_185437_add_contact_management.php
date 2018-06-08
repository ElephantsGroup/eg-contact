<?php

use yii\db\Migration;
use yii\db\Query;

/**
 * Class m180608_185437_add_contact_management
 */
class m180608_185437_add_contact_management extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$db = \Yii::$app->db;
		$query = new Query();
        if ($db->schema->getTableSchema("{{%auth_item}}", true) !== null)
		{
			if (!$query->from('{{%auth_item}}')->where(['name' => '/contact/admin/*'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> '/contact/admin/*',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'contact_management'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'contact_management',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'contact_manager'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'contact_manager',
					'type'			=> 1,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'administrator'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'administrator',
					'type'			=> 1,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
		}
        if ($db->schema->getTableSchema("{{%auth_item_child}}", true) !== null)
		{
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'contact_management', 'child' => '/contact/admin/*'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'contact_management',
					'child'		=> '/contact/admin/*'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'contact_manager', 'child' => 'contact_management'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'contact_manager',
					'child'		=> 'contact_management'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'administrator', 'child' => 'contact_manager'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'administrator',
					'child'		=> 'contact_manager'
				]);
		}
        if ($db->schema->getTableSchema("{{%auth_assignment}}", true) !== null)
		{
			if (!$query->from('{{%auth_assignment}}')->where(['item_name' => 'administrator', 'user_id' => 1])->exists())
				$this->insert('{{%auth_assignment}}', [
					'item_name'	=> 'administrator',
					'user_id'	=> 1,
					'created_at' => time()
				]);
		}
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		// it's not safe to remove auth data in migration down
    }
}
