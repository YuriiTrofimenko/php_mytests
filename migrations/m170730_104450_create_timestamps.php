<?php

use yii\db\Migration;

class m170730_104450_create_timestamps extends Migration
{
    public function safeUp()
    {
        $this->addColumn('categories', 'createdAt', $this->dateTime()->notNull());
        $this->addColumn('categories', 'updatedAt', $this->dateTime()->notNull());

        $this->addColumn('tests', 'createdAt', $this->dateTime()->notNull());
        $this->addColumn('tests', 'updatedAt', $this->dateTime()->notNull());

        $this->addColumn('questions', 'createdAt', $this->dateTime()->notNull());
        $this->addColumn('questions', 'updatedAt', $this->dateTime()->notNull());

        $this->addColumn('answers', 'createdAt', $this->dateTime()->notNull());
        $this->addColumn('answers', 'updatedAt', $this->dateTime()->notNull());
    }

    public function safeDown()
    {
        $this->dropColumn('categories', 'createdAt');
        $this->dropColumn('categories', 'updatedAt');

        $this->dropColumn('tests', 'createdAt');
        $this->dropColumn('tests', 'updatedAt');

        $this->dropColumn('questions', 'createdAt');
        $this->dropColumn('questions', 'updatedAt');

        $this->dropColumn('answers', 'createdAt');
        $this->dropColumn('answers', 'updatedAt');
    }
}
