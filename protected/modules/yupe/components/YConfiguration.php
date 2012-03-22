<?php

/**
 * Название YConfiguration класса
 * 
 * Класс работы с файлами конфигураций системы.
 * 
 * @author lamo2k123 <lamo2k123@gmail.com>
 * @version 0.2
 */

class YConfiguration extends CConfiguration {

    protected $file = null;
    
    public function __construct( $file ) {
        
        parent::__construct( $file );
        
        $this->file = $file;
    }

    /*
     * @todo: Функция создания файла.
     */
    
    /**
     * Обновление файла конфигураций.
     *
     * @param   array   $updates    Обновляемые значения
     * @param   int     $chmode     Права доступа на файл
     * @return  void
     */
    public function update( array $updates, $chmode = 0 ) {
        
        if( is_array( $updates ) || isset( $updates ) ) {
        
            $config = $this->mergeArray( $this->toArray(), $updates );

            $this->write( $config, $chmode );
            
        } else {
            // @todo: Вывод ошибок
        }

    }
    
    /**
     * Запись файла конфигураций.
     * 
     * @param   array   $config     Массив конфигурации
     * @param   int     $chmode     Права доступа на файл
     * @return  void
     */
    protected function write( array $config, $chmode = 0 ) {
        
        $date = date('r');
        $config = var_export( $config, true );

        $code = <<<PHP
<?php
/**
 * Файл был автоматически обработан системой.
 *
 * Дата: {$date}
 */

return {$config};

PHP;

        file_put_contents( $this->file, $code );

        /* 
         * Установка прав доступа при необхадимости 
         */
        if( $chmode ) {
            @chmod( $this->file, $chmode );
        }
        
    }
    
}

?>