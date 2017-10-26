<?php
/* @var $this FrapserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Видеооператоры',
);

$this->menu = array(
    array('label' => 'Добавить видеооператора', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Frapser.create",Yii::app()->user->id)),
    array('label' => 'Управление видеооператорами', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Frapser.admin",Yii::app()->user->id)),
);
?>

<h1>Видеооператоры</h1>

<p>
    Вы можете использовать операторы сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    или <b>=</b>) В начале каждого поля поиска.
</p>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'frapser-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'nick',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->nick), Frapser::getUrl($data->id,$data->nick))'
        ),
        array(
            'name' => 'class',
            'value' => 'Lookup::item("PlayerClassName",$data->class)',
            'filter' => Lookup::items('PlayerClassName'),
        ),
        array(
            'type' => 'raw',
            'name' => 'calc',
            'value' => 'CHtml::link(CHtml::encode($data->calc), $data->calc,array("target"=>"_blank"))',
            'filter' => FALSE,
        ),
        array(
            'name' => 'videoCount',
            'value' => '$data->videoCount',
            'filter' => FALSE,
        ),
    ),
));
?>
