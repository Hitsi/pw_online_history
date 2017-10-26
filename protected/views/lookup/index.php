<?php
/* @var $this LookupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Константы',
);

$this->menu = array(
    array('label' => 'Добавить константу', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Lookup.create",Yii::app()->user->id)),
);
?>

<h1>Константы</h1>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'lookup-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'name',
        'code',
        array(
            'type' => 'raw',
            'name' => 'type',
            'value' => '$data->type',
            'filter' => Lookup::droplist()
        ),
        'position',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
