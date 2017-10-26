<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs = array(
    'Комментарии' => array('index'),
    'Управление',
);


$this->menu = array(
    array('label' => 'Список комментариев', 'url' => array('index')),
    array('label' => 'Создать комментарий', 'url' => array('create')),
    array('label' => 'Изменить комментарий', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Удалить комментарий', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Управление комментариями', 'url' => array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#comment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление комментариями</h1>

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
echo Yii::app()->user->model()->FindByPk(1)->username;
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'comment-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        array(
            'type' => 'raw',
            'name' => 'create_time',
            'value' => 'Yii::app()->dateFormatter->format("EEEE d MMMM yyyy HH:mm",CHtml::encode($data->create_time))',
            'filter' => FALSE,
        ),
        'author',
        array(
            'type' => 'raw',
            'name' => 'authorId',
            'value' => 'Yii::app()->user->model()->FindByPk($data->authorId)->username',
        ),
        array(
            'type' => 'raw',
            'name' => 'gvg_id',
            'value' => 'Gvg::Model()->FindByPk($data->gvg_id)->datestart',
            'filter' => CHtml::listData(Gvg::model()->findAll(array('order' => 'datestart DESC')), 'id', 'datestart'),
        ),
       array(
            'name' => 'type',
            'value' => 'Lookup::item("CommentType",$data->type)',
            'filter' => Lookup::items('CommentType'),
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
