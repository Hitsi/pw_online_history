<?php
/* @var $this LibraryController */
/* @var $model Library */
$typename = Lookup::item('LibraryType', $model->type);
$this->breadcrumbs = array(
    'Библиотека' => array('index'),
    $typename => array('typeview', 'type' => $typename),
    $model->name,
);

$this->menu = array(
    array('label' => 'Список статей', 'url' => array('index')),
    array('label' => 'Создать статью', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Library.create",Yii::app()->user->id)),
    array('label' => 'Обновить статью', 'url' => array('update', 'name' => $model->name), 'visible' => Yii::app()->getAuthManager()->checkAccess("Library.update",Yii::app()->user->id)),
    array('label' => 'Удалить статью', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'name' => $model->name), 'confirm' => 'Вы уверены что хотите удалить?'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Library.delete",Yii::app()->user->id)),
    array('label' => 'Управление библиотекой', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Library.admin",Yii::app()->user->id)),
);
?>

<h1><?php echo $model->name; ?></h1>
<?php echo $model->info; ?>