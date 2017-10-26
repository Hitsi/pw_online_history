<?php
/* @var $this ClansController */
/* @var $model Clans */

$this->breadcrumbs = array(
    'Clans' => array('index'),
    $model->name => Clans::getUrl($model->id, $model->name),
    'Видео',
);

$this->menu = array(
    array('label' => 'Список кланов', 'url' => array('index')),
    array('label' => 'Инфо о клане', 'url' => array('view', 'id' => $model->id, 'name' => $model->name)),
    array('label' => 'Гвг клана', 'url' => array('gvg', 'id' => $model->id, 'name' => $model->name)),
    array('label' => 'Создать клан', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.create",Yii::app()->user->id)),
    array('label' => 'Обновить клан', 'url' => array('update', 'id' => $model->id), 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.update",Yii::app()->user->id)),
    array('label' => 'Удалить клан', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Вы уверены что хотите удалить?', 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.delete",Yii::app()->user->id))),
    array('label' => 'Управление кланами', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.admin",Yii::app()->user->id)),
);
?>

<h1>Видео клана <?php echo $model->name; ?></h1>
<?php echo $this->renderPartial('_info', array('model' => $model)); ?>

<?php
$dataProvider = new CActiveDataProvider('Video', array(
            'criteria' => array(
                'condition' => 'clan=' . $model->id,
                'order' => 'create_time DESC'
            ),
        ));

$model_video = new Video('search');
$model_video->unsetAttributes();  // clear any default values
if (isset($_GET['Video']))
    $model_video->attributes = $_GET['Video'];
$model_video->setAttributes(array('clan' => $model->id));

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'video-grid',
    'dataProvider' => $model_video->search(),
    'filter' => $model_video,
    //'afterAjaxUpdate'=>'function(id, data) {$( ".chzn-select-deselect" ).chosen([]);}',
    'columns' => array(
        array(
            'name' => 'title',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->title), $data->url)'
        ),
        array(
            'name' => 'create_time',
            'type' => 'date',
            'filter' => false,
        ),
        array(
            'name' => 'frapserid',
            'value' => '$data->frapser_info->nick',
            'filter' => Frapser::droplist(),
        //'filterHtmlOptions'=>array('class'=>'chzn-select-deselect'),
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
    /*
      'link',
      'battleid',
     */
    ),
));
?>
