<?php

use yii\db\Migration;

class m130521_201441_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'role_id' => $this->foreignkey(),
            /*'role' => $this->integer()->notNull()->defaultValue(10),*/
            'username' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(), 
            'dod' => $this->date()->notNull(),
            'about' => $this->text()->notNull(),
            'photo' => $this->string()->notNull(), 
            'is_admin' => $this->tinyint(1)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'contact_person' => $this->string()->notNull(),
            'slug_url' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
