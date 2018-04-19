<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tests`.
 */
class m170730_103232_create_tests_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('tests', [
            'id' => $this->primaryKey(),
            'categoryId' => $this->integer()->notNull(),
            'name' => $this->string(100)->notNull(),
            'questions' => $this->integer()->notNull(),
            'description' => $this->text(),
        ]);
        
        $this->createIndex('tests_name_categoryId', 'tests', ['name', 'categoryId'], true);
        $this->addForeignKey('tests_categoryId_FK', 'tests', 'categoryId', 'categories', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('tests');
    }
}
