<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Новости',
);

$this->menu = array(
    array('label' => 'Создать новость', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("News.create",Yii::app()->user->id)),
    array('label' => 'Управление новостями', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("News.admin",Yii::app()->user->id)),
);
?>

<h1>Новости</h1>

<?php
$dataProvider->sort->defaultOrder = 'date DESC';
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
