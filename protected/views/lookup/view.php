<?php
/* @var $this LookupController */
/* @var $model Lookup */

$this->breadcrumbs = array(
    'Константы' => array('index'),
    $model->type . "->" . $model->name,
);

$this->menu = array(
    array('label' => 'Список констант', 'url' => array('index'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Lookup.index",Yii::app()->user->id)),
    array('label' => 'Добавить константу', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Lookup.create",Yii::app()->user->id)),
    array('label' => 'Обновить константу', 'url' => array('update', 'id' => $model->id), 'visible' => Yii::app()->getAuthManager()->checkAccess("Lookup.update",Yii::app()->user->id)),
    array('label' => 'Удалить константу', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Вы точно хотите удалить?'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Lookup.delete",Yii::app()->user->id)),
);
?>

<h1>Просмотр константы <?php echo $model->type . "->" . $model->name; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
        'code',
        'type',
        'position',
    ),
));
?>
