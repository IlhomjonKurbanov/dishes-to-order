<?php

use yii\db\Migration;
use app\traits\migrations\CreateTableOptions;

/**
 * Handles the creation of table `{{%ingredients}}`.
 */
class m200930_092149_create_ingredients_table extends Migration
{
	use CreateTableOptions;

	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('{{%ingredients}}', [
			'id' => $this->primaryKey(),
			'title' => $this->string(191)->notNull()->unique(),
			// 'status' => $this->enum('active','passive'),
		], $this->createTableOptions());

		 $this->addColumn('ingredients', 'status', "enum('active','passive') COLLATE utf8_unicode_ci DEFAULT 'active'");

	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('{{%ingredients}}');
	}
}
