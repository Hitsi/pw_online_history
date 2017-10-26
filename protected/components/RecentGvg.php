<?php

Yii::import('zii.widgets.CPortlet');

class RecentGvg extends CPortlet {

    public $title = 'Последние ГВГ';
    public $maxGvg = 5;

    public function getRecentGvg() {
        return Gvg::model()->findRecentGvg($this->maxGvg);
    }

    protected function renderContent() {
        $this->render('recentGvg');
    }

}

?>