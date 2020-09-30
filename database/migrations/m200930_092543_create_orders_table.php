<?php

use yii\db\Migration;
use app\traits\migrations\CreateTableOptions;

/**
 * Handles the creation of table `{{%orders}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%dishes}}`
 * - `{{%ingredients}}`
 */
class m200930_092543_create_orders_table extends Migration
{
	use CreateTableOptions;

	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('{{%orders}}', [
			'id' => $this->primaryKey(),
			'dish_id' => $this->integer()->notNull(),
			'ingredient_id' => $this->integer()->notNull(),
			// 'status('active','passive')',
		], $this->createTableOptions());

		$this->addColumn('orders', 'status', "enum('active','passive') COLLATE utf8_unicode_ci DEFAULT 'active'");


		// creates index for column `dish_id`.
		$this->createIndex(
			'{{%idx-orders-dish_id}}',
			'{{%orders}}',
			'dish_id'
		);

		// add foreign key for table `{{%dishes}}`.
		$this->addForeignKey(
			'{{%fk-orders-dish_id}}',
			'{{%orders}}',
			'dish_id',
			'{{%dishes}}',
			'id',
			'CASCADE'
		);

		// creates index for column `ingredient_id`.
		$this->createIndex(
			'{{%idx-orders-ingredient_id}}',
			'{{%orders}}',
			'ingredient_id'
		);

		// add foreign key for table `{{%ingredients}}`.
		$this->addForeignKey(
			'{{%fk-orders-ingredient_id}}',
			'{{%orders}}',
			'ingredient_id',
			'{{%ingredients}}',
			'id',
			'CASCADE'
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		// drops foreign key for table `{{%dishes}}`.
		$this->dropForeignKey(
			'{{%fk-orders-dish_id}}',
			'{{%orders}}'
		);

		// drops index for column `dish_id`.
		$this->dropIndex(
			'{{%idx-orders-dish_id}}',
			'{{%orders}}'
		);

		// drops foreign key for table `{{%ingredients}}`.
		$this->dropForeignKey(
			'{{%fk-orders-ingredient_id}}',
			'{{%orders}}'
		);

		// drops index for column `ingredient_id`.
		$this->dropIndex(
			'{{%idx-orders-ingredient_id}}',
			'{{%orders}}'
		);

		$this->dropTable('{{%orders}}');
	}
}
