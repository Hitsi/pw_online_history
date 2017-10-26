<?php
/* @var $this LibraryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Библиотека',
);

$this->menu = array(
    array('label' => 'Создать статью', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Library.create",Yii::app()->user->id)),
    array('label' => 'Управление библиотекой', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Library.admin",Yii::app()->user->id)),
);
?>

<h1>Библиотека</h1>
<div class="library">
    <?php
    $level = 0;

    foreach ($models as $item) {


        if ($item->type == $level) {
            echo "</li>\n";
        } else if ($item->type > $level) {
            if ($level > 0)
                echo "</ul>\n";
            echo "<h3>" . CHtml::link(Lookup::item("LibraryType", $item->type), array('typeview', 'type' => Lookup::item("LibraryType", $item->type))) . "</h3>\n";
            echo "<ul>\n";
        }


        echo "<li>";
        echo CHtml::link(Chtml::encode($item->name), array('view', 'type' => Lookup::item("LibraryType", $item->type), 'name' => $item->name));
        $level = $item->type;
    }

    echo "</li>\n</ul>\n";
    ?>

</div>

