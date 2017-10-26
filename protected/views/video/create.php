<?php
/* @var $this VideoController */
/* @var $model Video */

$this->breadcrumbs = array(
    'Видео' => array('index'),
    'Добавление',
);

$this->menu = array(
    array('label' => 'Список видео', 'url' => array('index')),
    array('label' => 'Управление видео', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Video.admin",Yii::app()->user->id)),
    array('label' => 'Добавить видеооператора', 'url' => array('frapser/create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Frapser.create",Yii::app()->user->id)),
);
?>

<h1>Добавление видео</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>