<?php
/* @var $this GvgController */
/* @var $model Gvg */

$this->breadcrumbs = array(
    'Гвг' => array('index'),
    'Создать',
);

$this->menu = array(
    array('label' => 'Список Гвг', 'url' => array('index')),
    array('label' => 'Управление Гвг', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Gvg.create",Yii::app()->user->id)),
);
?>

<h1>Создание гвг</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>