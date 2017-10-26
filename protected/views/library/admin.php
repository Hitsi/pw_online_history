<?php
/* @var $this LibraryController */
/* @var $model Library */

$this->breadcrumbs = array(
    'Библиотека' => array('index'),
    'Управление',
);

$this->menu = array(
    array('label' => 'Список статей', 'url' => array('index')),
    array('label' => 'Создать статью', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Library.create",Yii::app()->user->id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#library-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление библиотекой</h1>

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
    'id' => 'library-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'type',
        'name',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
