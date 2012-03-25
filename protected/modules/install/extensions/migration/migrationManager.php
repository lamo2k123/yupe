<?php
/**
 * Менеджер файлов с этапами миграций
 *
 * @package Tools
 * @subpackage Classes
 * @copyright 2012 AlterVega (http://altervega.ru)
 * @license   http://altervega.ru/license/
 * @version   1.0.0
 *
 */

/**
 * Менеджер файлов с этапами миграций
 */

require_once Yii::app()->basePath . '/modules/yupe/extensions/migration/EDbMigration.php';
//require_once Yii::app()->basePath . '/modules/yupe/migrations/m000000_000000_Core.php';
        

class migrationManager extends EDbMigration {
    
    /**
     * Путь к директории модулей
     * 
     * @var string
     */
    protected $_files_path = '';

    /**
     * Конструктор класса
     *
     * @param string $files_path Путь к директориии с файлами
     */
    public function  __construct( $files_path )
    {
        if( !is_dir( $files_path ) || !is_readable( $files_path ) )
        {

            // Ошибка
            
        }

        $this->_files_path = $files_path;
    }

    /**
     * Получение списка этапов для приложения
     *
     * @param string $app   Приложение
     * @param int    $start Начальная миграция
     * @return array
     */
    public function getList( $app = 'yupe', $start = 0 ) {
        
        $asdsa = Yii::app()->db->createCommand( "SELECT * FROM `yupe_migration` WHERE  `module` =  'yupe' ORDER BY `yupe_migration`.`version` DESC LIMIT 0, 1" )->queryColumn();
        
        $list = array();
        $files = scandir( $this->_files_path . '/' . $app . '/migrations/' );

        if( $app ) {
            
            foreach( $files as $file ) {
                
                if( preg_match( '/^m(\d{6})_(\d{6})_' . $app . '\.php$/', $file, $matches ) ) {
                    
                    if( $matches[1].$matches[2] > $start ) {
                        $list[] = 'm' . $matches[1] . '_' . $matches[2];
                    }
                    
                }
                
            }
            
        } else {

            foreach( $files as $file ) {

                if( preg_match( '/^([A-Z][a-z]+)_(\d{10})\.php$/', $file, $matches ) ) {
                    $list[ $matches[1] ][] = $matches[2];
                }
            
            }
        
        }
        return $asdsa;
        //return $list;
    }

    /**
     * Получение штампа следующего этапа
     *
     * @param string $app  Приложение
     * @param int    $from Штамп начала поиска
     * @return string
     */
    public function getNextMigration( $app, $from )
    {
        foreach( scandir( $this->_files_path, 0 ) as $file )
        {
            if( preg_match( '/^' . $app . '_(\d{10})\.php$/',
                                                            $file, $matches ) )
            {
                if( $matches[1] > $from )
                {
                    return $matches[1];
                }
            }
        }

        return false;
    }

    /**
     * Получение штампа предыдушего этапа
     *
     * @param string $app  Приложение
     * @param int    $from Штамп начала поиска
     * @return string
     */
    public function getPreviousMigration( $app, $from )
    {
        foreach( scandir( $this->_files_path, 1 ) as $file )
        {
            if( preg_match( '/^' . $app . '_(\d{10})\.php$/',
                                                            $file, $matches ) )
            {
                if( $matches[1] < $from )
                {
                    return $matches[1];
                }
            }
        }

        return false;
    }

    /**
     * Выполнение этапа
     *
     * @param string $what  up или down
     * @param string $app   Приложение
     * @param int    $stage Штамп этапа
     * @param string $db    Ключ настроек базы данных
     * @return void
     */
    public function stageDo( $what, $app, $stage, $db = 'default' )
    {
        $class = $app . '_' . $stage;
        $file = $this->_files_path . $class . '.php';

        if( !is_readable( $file ) )
        {
            throw new jE_Exception( jE::translate( 'tools' )->
                    {'Невозможно прочитать файл миграции "%s"'}( $file ) );
        }

        require_once $file;

        $db = jE::db( $db );
        call_user_func_array( array( $class, $what ), array( $db ) );

        $this->_logAppStage( $what, $app, $stage, $db );
    }

    /**
     * Получение текущей стадии для приложения
     *
     * @param string $app Имя приложения
     * @param string $db  Ключ настроек базы данных
     * @return int
     */
    public function getAppStage( $app, $db = 'default' )
    {
        static $app_stages = array();

        if( empty( $app_stages ) )
        {
            try
            {
                $result = jE::db()->runQuery( 'SELECT * FROM Migrate_Stages' );
            }
            catch( Exception $e )
            {
                $result = array();
            }

            foreach( $result as $row )
            {
                $app_stages[ $row['application'] ] = $row['stage'];
            }
        }

        return isset( $app_stages[ $app ] ) ? $app_stages[ $app ] : '0000000000';
    }

    /**
     * Получение списка установленных стадии для приложения
     *
     * @param string $app Имя приложения
     * @param string $db  Ключ настроек базы данных
     * @return int
     */
    public function getCurrentAppStages( $app,  $db = 'default' )
    {
        try
        {
            $result = jE::db( $db )->runQuery(
                'SELECT DISTINCT stage
                 FROM Migrate_Log
                 WHERE application = "' . $app .'"'
            );
        }
        catch( Exception $e )
        {
            $result = array();
        }

        $app_stages = array();

        foreach( $result as $row )
        {
            $app_stages[] = $row['stage'];
        }

        return $app_stages;
    }

    /**
     * Сохранение стадии для приложения
     *
     * @param string $app   Имя приложения
     * @param int    $stage Штамп этапа
     * @param string $db    Ключ настроек базы данных
     * @return void
     */
    public function setAppStage( $app, $stage, $db = 'default' )
    {
        jE::db( $db )->runQuery( 'INSERT INTO Migrate_Stages
                             VALUES("' . $app . '", "' . $stage . '")
                             ON DUPLICATE KEY UPDATE stage = "' . $stage . '"');
    }

    /**
     * Удаление отметки стадии для приложения
     *
     * @param string $app Имя приложения
     * @return void
     * @throws jE_Cli_Exception
     */
    protected function deleteAppStage( $app, $db = 'default' )
    {
        jE::db( $db )->runQuery( 'DELETE FROM Migrate_Stages
                                 WHERE application = "' . $app . '"' );
    }

    /**
     * Журналирование стадии для приложения
     *
     * @param string $what  up или down
     * @param string $app   Приложение
     * @param int    $stage Штамп этапа
     * @param jE_Db_Driver_Abstract $db Объект базы данных
     * @return void
     */
    protected function _logAppStage( $what, $app, $stage, jE_Db_Driver_Abstract $db )
    {
        if ( 'up' == $what )
        {
            $db->runQuery( 'INSERT INTO Migrate_Log
                 VALUES( NULL, "' . $app . '", "' . $stage . '")' );
        }
        else
        {
            $db->runQuery( 'DELETE FROM Migrate_Log
                 WHERE application = "' . $app . '" AND stage = "' . $stage . '"' );
        }
    }
}