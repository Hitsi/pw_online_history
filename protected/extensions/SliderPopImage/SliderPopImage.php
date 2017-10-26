<?php

/**
 * SliderPopImage
 * =================
 * This extension is  a popup thumnails and show the original images as a popup picture does.
 * In addition where is an option to navigate between the images
 * Links:
 * - SliderPopImage demo: http://www.webkit.gr/index.php/Apps/mountainpopup
 * - SliderPopImage site: http://www.yiiframework.com/extension/sliderpopimage
 *
 * @version 1.1
 * @author Konstaninos Apazidis <konapaz@gmail.com>
 * @date 19 May 2013
 * @update 26 June 2013
 * */
class SliderPopImage extends CWidget {

    public $selectorImgPop = '.popupimage-link';
    public $popupwithpaginate = true;
    public $maxpopuwidth = '$(window).width()';
    public $postfixThumb = '_thumb';
    public $relPathThumbs = 'thumbs';

    public function run() {
        $assets = Yii::app()->getAssetManager()->publish(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets', false, -1, YII_DEBUG);
        Yii::app()->clientScript->registerScript('sliderpopupAssetsVar', "var mypopimageAssets='" . $assets . "', popupwithpaginate=" . (($this->popupwithpaginate) ? 'true' : 'false') .
                ", selectorImgPop ='" . $this->selectorImgPop . "', maxpopuwidth=" . $this->maxpopuwidth .
                ", postfixThumb ='" . $this->postfixThumb . "', relPathThumbs=" . (is_array($this->relPathThumbs) ? json_encode($this->relPathThumbs) : "'" . $this->relPathThumbs . "'") . ";", CClientScript::POS_HEAD);


        Yii::app()->getClientScript()->registerScriptFile($assets . '/sliderpopimage.js', CClientScript::POS_HEAD);
        Yii::app()->getClientScript()->registerCssFile($assets . '/sliderpopimage.css', '', CClientScript::POS_HEAD); // ''=> 'screen' or 'print'
        ?>

        <div id="backgroundPopup" ></div>
        <div id="popupBox">
            <img id='poptheimg' src="" />
            <div id="block-arr">
                <img class="arrow" id="arrow-l" src="<?php echo $assets; ?>/arrow-left.png" />
                <img class="arrow" id="arrow-r" src="<?php echo $assets; ?>/arrow-right.png" />
            </div>
            <img id="close-but" src="<?php echo $assets; ?>/close-button.png" />
        </div>

        <?php
        Yii::app()->clientScript->registerScript('sliderpopupTrans', '$("#popupBox").prependTo($("body")); $("#backgroundPopup").prependTo($("body"));', CClientScript::POS_READY);
    }

}
?>
