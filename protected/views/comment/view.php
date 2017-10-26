<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs = array(
    'Comments' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Список комментариев', 'url' => array('index')),
    array('label' => 'Создать комментарий', 'url' => array('create')),
    array('label' => 'Изменить комментарий', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Удалить комментарий', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Управление комментариями', 'url' => array('admin')),
);
?>

<h1>View Comment #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'content',
        'create_time',
        'author',
        'type',
        'gvg_id',
    ),
));
?>
