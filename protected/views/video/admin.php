<?php
/* @var $this VideoController */
/* @var $model Video */

$this->breadcrumbs = array(
    'Видео' => array('index'),
    'Управление',
);

$this->menu = array(
    array('label' => 'Список видео', 'url' => array('index')),
    array('label' => 'Добавить видео', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Video.create",Yii::app()->user->id)),
    array('label' => 'Добавить видеооператора', 'url' => array('frapser/create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Frapser.create",Yii::app()->user->id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#video-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
$this->widget('ext.EChosen.EChosen', array(
    'target' => '.chzn-select-deselect',
    'useJQuery' => true,
));
?>

<h1>Управление видеозаписями</h1>

<p>
    Вы можете использовать операторы сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    или <b>=</b>) В начале каждого поля поиска.
</p>

<?php echo CHtml::link('Расширенный поиск', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'video-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    //'afterAjaxUpdate'=>'function(id, data) {$( ".chzn-select-deselect" ).chosen([]);}',
    'columns' => array(
        array(
            'name' => 'title',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->title), $data->url)',
        ),
        array(
            'name' => 'create_time',
            'type' => 'raw',
            'value' => 'Yii::app()->dateFormatter->format("y-MM-d ",$data->create_time)',
        ),
        array(
            'name' => 'frapserid',
            'value' => '$data->frapser_info->nick',
            'filter' => Frapser::droplist(),
        //'filterHtmlOptions'=>array('class'=>'chzn-select-deselect'),
        ),
        array(
            'name' => 'clan',
            'value' => '$data->clan_info->name',
            'filter' => Clans::droplist(),
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
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("video/view",array("id"=>$data->id,"title"=>$data->title))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("video/update",array("id"=>$data->id,"title"=>$data->title))',
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("video/delete",array("id"=>$data->id,"title"=>$data->title))',
                ),
            ),
        ),
    ),
));
?>
