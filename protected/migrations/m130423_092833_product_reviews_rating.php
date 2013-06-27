<?php

class m130423_092833_product_reviews_rating extends CDbMigration
{
	public function up()
	{
            $table = "product_reviews";
        $this->addColumn($table, "avatar", "varchar(255) DEFAULT NULL");
	}

	public function down()
	{
		$table = "product_reviews";
              $this->dropColumn($table, "avatar");
	}

}