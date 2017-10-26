<?php
/* @var $this LibraryController */
/* @var $model Library */

$this->breadcrumbs = array(
    'Библиотека' => array('index'),
    $type => array('typeview', 'type' => $type),
);

$this->menu = array(
    array('label' => 'Список статей', 'url' => array('index')),
    array('label' => 'Создать статью', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Library.create",Yii::app()->user->id)),
    array('label' => 'Управление библиотекой', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Library.admin",Yii::app()->user->id)),
);
?>

<h1><?php echo $type; ?></h1>
<div class="library">
    <ul>
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_typeview',
        ));
        ?>
        </li>
    </ul>
</div>
