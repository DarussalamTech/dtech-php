<?php

class m150105_125050_shippingweighttype extends CDbMigration
{
	public function up()
	{
                $this->alterColumn('shipping_class', 'min_weight_id', 'double');
                $this->alterColumn('shipping_class', 'max_weight_id', 'double');
	}

	public function down()
	{
		echo "m150105_125050_shippingweighttype does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}