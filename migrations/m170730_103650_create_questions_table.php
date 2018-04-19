<?php

use yii\db\Migration;

class m170730_103650_create_questions_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('questions', [
            'id' => $this->primaryKey(),
            'testId' => $this->integer()->notNull(),
            'text_' => $this->text()->notNull()
        ]);

        $this->addForeignKey('questions_testId_FK', 'questions', 'testId', 'tests', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('questions');
    }
}
