<?php
/* @var $this ResponceController */
/* @var $model Responce */

$this->breadcrumbs = array(
    'Обратная связь' => array('index'),
    $model->title => array('view', 'id' => $model->id),
    'Обновление',
);

$this->menu = array(
    array('label' => 'Написать сообщение', 'url' => array('index')),
    array('label' => 'Просмотреть сообщение', 'url' => array('view', 'id' => $model->id), 'visible' => Yii::app()->getAuthManager()->checkAccess("Responce.view",Yii::app()->user->id)),
    array('label' => 'Управление сообщениями', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Responce.admin",Yii::app()->user->id)),
);
?>

<h1>UОбновление сообщения <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>