<?php

class core_000000001 extends CDbMigration {
    
    public function up() {
    
        $this->createTable( 'tbl_migration', array (
            'version' => 'varchar(255) NOT NULL',
            'apply_time' => 'int(11) DEFAULT NULL'
        ));
        
    }

    CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

    
    public function down() {
		echo "m120322_184456_core does not support migration down.\n";
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