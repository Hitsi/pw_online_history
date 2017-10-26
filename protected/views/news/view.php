<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    'Новости' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'Список новостей', 'url' => array('index')),
    array('label' => 'Создать новость', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("News.create",Yii::app()->user->id)),
    array('label' => 'Обновить новость', 'url' => array('update', 'id' => $model->id, 'title' => $model->title), 'visible' => Yii::app()->getAuthManager()->checkAccess("News.update",Yii::app()->user->id)),
    array('label' => 'Удалить новость', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id, 'title' => $model->title), 'confirm' => 'Вы уверены что хотите удалить?'), 'visible' => Yii::app()->getAuthManager()->checkAccess("News.delete",Yii::app()->user->id)),
    array('label' => 'Управление новостями', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("News.admin",Yii::app()->user->id)),
);
?>

<h1>Просмотр новости #<?php echo $model->title; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'title',
        array(
          'type'=>'raw',
          'name'=>'date',
          'value'=>Yii::app()->dateFormatter->format("EEEE d MMMM yyyy HH:mm", $model->date),
        ),
        array(
            'type' => 'html',
            'name' => 'info',
            'value' => $model->info,
        ),
    ),
));
?>
