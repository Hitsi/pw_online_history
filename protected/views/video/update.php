<?php
/* @var $this VideoController */
/* @var $model Video */

$this->breadcrumbs = array(
    'Видео' => array('index'),
    $model->title => array('view', 'id' => $model->id, 'title' => $model->title),
    'Обновление',
);

$this->menu = array(
    array('label' => 'Список видео', 'url' => array('index')),
    array('label' => 'Просмотр видео', 'url' => array('view', 'id' => $model->id, 'title' => $model->title)),
    array('label' => 'Добавить видео', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Video.create",Yii::app()->user->id)),
    array('label' => 'Управление видео', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Video.admin",Yii::app()->user->id)),
    array('label' => 'Добавить видеооператора', 'url' => array('frapser/create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Frapser.create",Yii::app()->user->id)),
);
?>

<h1>Обвновление видео <?php echo $model->title; ?></h1>
<?php echo Frapser::model()->findByPk(Video::model()->FindByPk($_GET['id'])->frapserid)->owner;?>
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>