<?php

/*
 * Миграция {ClassName}
 *
 * @package   <Название пакета модуля>
 * @version   0.1
 *
 */

class {ClassName} extends EDbMigration {

    /*
     * Приминение стадии миграции.
     */
    public function up() {

        
        
    }

    /*
     * Отмена стадии миграции.
     */
    public function down() {
    
        //echo "m120323_174235_asdasdasd does not support migration down.\n";
        //return false;
    
    }

    
    /*
     * Миграция начнется с транзакции, а затем выполнит safeUp() или safeDown()
     * Если возникнет какая-либо ошибка, произойдёт откат транзакции в начальное состояние.
     */    

    // public function safeUp() {}
    // public function safeDown() {}
    
}