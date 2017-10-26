<?php
/* @var $this FrapserController */
/* @var $model Frapser */

$this->breadcrumbs = array(
    'Видеооператоры' => array('index'),
    $model->nick,
);

$this->menu = array(
    array('label' => 'Список видеооператоров', 'url' => array('index')),
    array('label' => 'Добавить видеооператора', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Frapser.create",Yii::app()->user->id)),
    array('label' => 'Обновить видеоператора', 'url' => array('update', 'id' => $model->id, 'nick' => $model->nick), 'visible' => Yii::app()->getAuthManager()->checkAccess("Frapser.update",Yii::app()->user->id)),
    array('label' => 'Удалить видеооператора', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id, 'nick' => $model->nick), 'confirm' => 'Вы уверены что хотите удалить?'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Frapser.delete",Yii::app()->user->id)),
    array('label' => 'Управление видеооператорами', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Frapser.admin",Yii::app()->user->id)),
);
?>

<h1>Видеоператор <?php echo $model->nick; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'type' => 'raw',
            'name' => 'nick',
            'value' => $model->nick,
        ),
        array(
            'type' => 'raw',
            'name' => 'class',
            'value' => Lookup::item("PlayerClassName", $model->class),
        ),
        array(
            'type' => 'raw',
            'name' => 'calc',
            'value' => CHtml::link(CHtml::encode($model->calc), $model->calc, array("target" => "_blank")),
        ),
        array(
            'type' => 'html',
            'name' => 'info',
            'value' => $model->info,
        ),
    ),
));
?>
<br/>
<h3>Все видео</h3>
<?php
$model_video = new Video('search');
$model_video->unsetAttributes();  // clear any default values
if (isset($_GET['Video']))
    $model_video->attributes = $_GET['Video'];
$model_video->setAttributes(array('frapserid' => $model->id));


$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'video-grid',
    'dataProvider' => $model_video->search(),
    'filter' => $model_video,
    'columns' => array(
        array(
            'name' => 'title',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->title), $data->url)',
        ),
        array(
            'name' => 'create_time',
            'type' => 'date',
            'filter' => false,
        ),
        array(
            'type' => 'raw',
            'name' => 'clan',
            'value' => 'Clans::getIcon($data->clan_info->id, $data->clan_info->name, $data->clan_info->image).CHtml::link(CHtml::encode($data->clan_info->name), Clans::getGvgurl($data->clan_info->id,$data->clan_info->name))',
            'filter' => Clans::droplist(),
        ),
        array(
            'type' => 'raw',
            'name' => 'type',
            'value' => 'Lookup::item("VideoType",$data->type)',
            'filter' => Lookup::items('VideoType'),
        ),
    ),
));
?>
