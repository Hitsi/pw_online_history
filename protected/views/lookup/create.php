<?php
/* @var $this LookupController */
/* @var $model Lookup */

$this->breadcrumbs = array(
    'Константы' => array('index'),
    'Добавление',
);

$this->menu = array(
    array('label' => 'Список констант', 'url' => array('index'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Lookup.index",Yii::app()->user->id)),
);
?>

<h1>Добавить константу</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>