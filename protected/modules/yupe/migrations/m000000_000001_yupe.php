<?php

/*
 * Миграция m000000_000000_Core
 *
 * @package   <Название пакета модуля>
 * @version   0.1
 *
 */

class m000000_000001_yupe extends EDbMigration {

    /*
     * Приминение стадии миграции.
     */
    public function up() {
        
        $this->execute(
            "CREATE TABLE IF NOT EXISTS `{{ssmigration}}` (
                `version` varchar(255) NOT NULL,
                `apply_time` int(11) DEFAULT NULL,
                `module` varchar(32) DEFAULT NULL,
                PRIMARY KEY (`version`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8"
        );

    }

    /*
     * Отмена стадии миграции.
     */
    public function down() {
        
        $this->execute(
            "DROP TABLE `{{ssmigration}}`"
        );
    
    }

    
    /*
     * Миграция начнется с транзакции, а затем выполнит safeUp() или safeDown()
     * Если возникнет какая-либо ошибка, произойдёт откат транзакции в начальное состояние.
     */    

    // public function safeUp() {}
    // public function safeDown() {}
    
}
