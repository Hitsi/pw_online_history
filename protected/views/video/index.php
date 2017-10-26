<?php
/* @var $this VideoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Видео',
);

$this->menu = array(
    array('label' => 'Добавить видео', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Video.create",Yii::app()->user->id)),
    array('label' => 'Управление видео', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Video.admin",Yii::app()->user->id)),
    array('label' => 'Добавить видеооператора', 'url' => array('frapser/create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Frapser.create",Yii::app()->user->id)),
);
?>

<h1>Видео</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'video-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'title',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->title), $data->url)'
        ),
        array(
            'name' => 'create_time',
            'type' => 'raw',
            'value' => 'Yii::app()->dateFormatter->format("dd-MM-y ",$data->create_time)',
        ),
        array(
            'type' => 'raw',
            'name' => 'frapserid',
            'value' => 'CHtml::link(CHtml::encode($data->frapser_info->nick), Frapser::getUrl($data->frapser_info->id,$data->frapser_info->nick))',
            'filter' => Frapser::droplist(),
        ),
        array(
            'type'=>'html',
            'name' => 'clan',
            'value' => 'Clans::getIcon($data->clan_info->id, $data->clan_info->name, $data->clan_info->image).CHtml::link(CHtml::encode($data->clan_info->name), Clans::getGvgurl($data->clan_info->id,$data->clan_info->name))',
            'filter' => Clans::droplist(),
        ),
        array(
            'name' => 'type',
            'value' => 'Lookup::item("VideoType",$data->type)',
            'filter' => Lookup::items('VideoType'),
        ),
        array(
            'name' => 'class',
            'value' => 'Lookup::item("PlayerClassName",$data->class)',
            'filter' => Lookup::items('PlayerClassName'),
        ),
    ),
));
?>
