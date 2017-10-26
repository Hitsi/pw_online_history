<?php
/* @var $this LookupController */
/* @var $model Lookup */

$this->breadcrumbs = array(
    'Константы' => array('index'),
    $model->name => array('view', 'id' => $model->id),
    'Обновление',
);

$this->menu = array(
    array('label' => 'Список констант', 'url' => array('index'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Lookup.index",Yii::app()->user->id)),
    array('label' => 'Добавить константу', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Lookup.create",Yii::app()->user->id)),
    array('label' => 'Посмотрет константу', 'url' => array('view', 'id' => $model->id), 'visible' => Yii::app()->getAuthManager()->checkAccess("Lookup.view",Yii::app()->user->id)),
);
?>

<h1>Обновление константы <?php echo $model->type . " - " . $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>