<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    'Новости' => array('index'),
    'Управление',
);

$this->menu = array(
    array('label' => 'Список новостей', 'url' => array('index')),
    array('label' => 'Создать новость', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("News.create",Yii::app()->user->id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#news-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление новостями</h1>

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
    'id' => 'news-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'title',
        'date',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("news/view",array("id"=>$data->id,"title"=>$data->title))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("news/update",array("id"=>$data->id,"title"=>$data->title))',
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("news/delete",array("id"=>$data->id,"title"=>$data->title))',
                ),
            ),
        ),
    ),
));
?>
