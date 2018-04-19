<?php

use yii\db\Migration;

class m170730_103913_create_answers_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('answers', [
            'id' => $this->primaryKey(),
            'questionId' => $this->integer()->notNull(),
            'isTrue' => $this->integer(1)->notNull(),
            'text_' => $this->text()->notNull()
        ]);

        $this->addForeignKey('answers_questionId_FK', 'answers', 'questionId', 'questions', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('answers');
    }
}
