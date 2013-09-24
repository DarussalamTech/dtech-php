<?php

class m130626_124050_updateUserName extends DTDbMigration {

    public function up() {
        $sql = "UPDATE user SET user.user_name = user.user_email"
                . " WHERE user.user_name IS NULL OR user.user_name =''";
        $this->execute($sql);
    }

    public function down() {
        return true;
    }

}