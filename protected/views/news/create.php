<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    'Новости' => array('index'),
    'Создание',
);

$this->menu = array(
    array('label' => 'Список новостей', 'url' => array('index')),
    array('label' => 'Управление новостями', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("News.admin",Yii::app()->user->id)),
);
?>

<h1>Создать новость</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>