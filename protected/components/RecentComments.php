<?php

Yii::import('zii.widgets.CPortlet');

class RecentComments extends CPortlet {

    public $title = 'Последние комментарии';
    public $maxComments = 5;

    public function getRecentComments() {
        return Comment::model()->findRecentComments($this->maxComments);
    }

    protected function renderContent() {
        $this->render('recentComments');
    }

}

?>
