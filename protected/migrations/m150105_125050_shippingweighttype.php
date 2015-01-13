<?php

class m150105_125050_shippingweighttype extends DTDbMigration
{
	public function up()
	{
            $this->alterColumn('shipping_class', 'min_weight_id', 'double');
            $this->alterColumn('shipping_class', 'max_weight_id', 'double');
	}

	public function down()
	{
            $this->alterColumn('shipping_class', 'max_weight_id', 'int');
            $this->alterColumn('shipping_class', 'min_weight_id', 'int');
	}
}