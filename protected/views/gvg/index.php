<?php
/* @var $this GvgController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Гвг',
);
    $this->menu = array(
        array('label' => 'Создать гвг', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Gvg.create",Yii::app()->user->id)),
        array('label' => 'Управление гвг', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Gvg.admin",Yii::app()->user->id)),
    );
?>

<h1>Гвг</h1>

<p>
    Вы можете использовать операторы сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    или <b>=</b>) В начале каждого поля поиска.
</p>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'gvg-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'datestart',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->datestart), $data->getUrl($data->datestart))'
        ),
        array(
            'name' => 'dateend',
            'type' => 'raw',
            'value' => '$data->dateend',
            'filter' => false,
        ),
        array(
            'name' => 'battleCount',
            'type' => 'raw',
            'value' => '$data->battleCount',
            'filter' => false,
        ),
    ),
));
?>
