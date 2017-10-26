<?php
/* @var $this ClansController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Кланы',
);

$this->menu = array(
    array('label' => 'Список кланов', 'url' => array('index')),
    array('label' => 'Создать клан', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.create",Yii::app()->user->id)),
    array('label' => 'Управление кланами', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.admin",Yii::app()->user->id)),
);
?>

<h1>Кланы</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'clans-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'name',
            'type' => 'raw',
            'value' => 'Clans::getIcon($data->id, $data->name, $data->image, "16","small_img left").CHtml::link(CHtml::encode($data->name), $data->url)'
        ),
        array(
            'name' => 'type',
            'value' => 'Lookup::item("ClanType",$data->type)',
            'filter' => Lookup::items('ClanType'),
        ),
        array(
            'name' => 'kh',
            'value' => 'Lookup::item("KhExist",$data->kh)',
            'filter' => Lookup::items('KhExist'),
        ),
        array(
            'name' => 'site',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->site), $data->site, array("target"=>"_blank"))',
            'filter' => false,
        ),
    /*
      'type',
      'academ',
      'info',
     */
    ),
));
?>
