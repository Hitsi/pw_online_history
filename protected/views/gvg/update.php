<?php
/* @var $this GvgController */
/* @var $model Gvg */

$this->breadcrumbs = array(
    'Гвг' => array('index'),
    $model->datestart => array('view', 'datestart' => $model->datestart),
    'Обновление',
);

$this->menu = array(
    array('label' => 'Список гвг', 'url' => array('index')),
    array('label' => 'Создать гвг', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Gvg.create",Yii::app()->user->id)),
    array('label' => 'Просмотр гвг', 'url' => array('view', 'datestart' => $model->datestart)),
    array('label' => 'Управление гвг', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Gvg.admin",Yii::app()->user->id)),
);
?>

<h1>Обновление гвг с <?php echo $model->datestart; ?> по <?php echo $model->dateend; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>