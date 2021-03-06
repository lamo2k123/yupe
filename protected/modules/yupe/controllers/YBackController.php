<?php
class YBackController extends Controller
{
    public $menu = array();

    public $breadcrumbs = array();

    public function filters()
    {
        return array(
            array('application.modules.yupe.filters.YBackAccessControl')
        );
    }

    public function init()
    {
        $module = Yii::app()->getModule('yupe');
        $this->layout = $module->backendLayout;
        $jqueryslidemenupath = Yii::app()->assetManager->publish($module->basePath . '/web/jqueryslidemenu/');        
        Yii::app()->clientScript->registerCssFile($jqueryslidemenupath . '/jqueryslidemenu.css');
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
        Yii::app()->clientScript->registerCssFile(
            Yii::app()->clientScript->getCoreScriptUrl() .
            '/jui/css/base/jquery-ui.css'
        );
        Yii::app()->clientScript->registerScriptFile($jqueryslidemenupath . '/jqueryslidemenu.js');
        //$bootstrapPath = Yii::app()->assetManager->publish($module->basePath . '/web/bootstrap/');        
        //Yii::app()->clientScript->registerCssFile($bootstrapPath . '/css/bootstrap.min.css');        
        $this->setPageTitle(Yii::t('yupe', 'Панель управления'));
    }
}