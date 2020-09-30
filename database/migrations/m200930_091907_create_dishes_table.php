<?php

use yii\db\Migration;
use app\traits\migrations\CreateTableOptions;

/**
 * Handles the creation of table `{{%dishes}}`.
 */
class m200930_091907_create_dishes_table extends Migration
{
	use CreateTableOptions;

	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('{{%dishes}}', [
			'id' => $this->primaryKey(),
			'title' => $this->string(191)->notNull()->unique(),
			// 'status' => $this->enum('active','passive'),
		], $this->createTableOptions());

		 $this->addColumn('dishes', 'status', "enum('active','passive') COLLATE utf8_unicode_ci DEFAULT 'active'");

	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('{{%dishes}}');
	}
}
