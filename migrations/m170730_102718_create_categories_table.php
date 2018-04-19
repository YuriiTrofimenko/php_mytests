<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categories`.
 */
class m170730_102718_create_categories_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'parentId' => $this->integer()
        ]);

        $this->createIndex('categories_name_parentId', 'categories', ['name', 'parentId'], true);
        $this->addForeignKey('categories_parentId_FK', 'categories', 'parentId', 'categories', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('categories');
    }
}
