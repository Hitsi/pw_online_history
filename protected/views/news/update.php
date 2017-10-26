<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    'Новости' => array('index'),
    $model->title => array('view', 'id' => $model->id, 'title' => $model->title),
    'Обновление',
);

$this->menu = array(
    array('label' => 'Список новостей', 'url' => array('index')),
    array('label' => 'Создать новость', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("News.create",Yii::app()->user->id)),
    array('label' => 'Просмотр новости', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Управление новостями', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("News.admin",Yii::app()->user->id)),
);
?>

<h1>Обновление новости <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>