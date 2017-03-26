<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_new`.
 */
class m170110_015220_create_user_new_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_new', [
            'id' => $this->primaryKey(),
            'user_info'=>$this->text(),
            'user_time'=>$this->dateTime()->notNull()->defaultValue('2016-12-31 12:00:00'),
            'user_sex'=>$this->smallInteger()->notNull()->defaultValue(1)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_new');
    }
}
