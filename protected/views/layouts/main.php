<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <?php
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
        ?>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="container" id="page">

            <div id="header">
                <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
            </div><!-- header -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Новости', 'url' => array('/news/')),
                        //array('label'=>'Home', 'url'=>array('/site/index')),
                        //array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                        //array('label'=>'Contact', 'url'=>array('/site/contact')),
                        array('label' => 'Гвг', 'url' => array('/gvg/')),
                        array('label' => 'Сражения', 'url' => array('/battle/')),
                        array('label' => 'Кланы', 'url' => array('/clans/')),
                        array('label' => 'Видео', 'url' => array('/video/')),
                        array('label' => 'Видеооператоры', 'url' => array('/frapser/')),
                        array('label' => 'Библиотека', 'url' => array('/library/')),
                        //array('label'=>'Пользователи', 'url'=>array('/user/')),
                        array('label' => 'Обратная связь', 'url' => array('/responce/')),
                        array('label' => 'Гостевая', 'url' => array('/guestbook/')),
                        array('label' => 'Профиль', 'url'=>array('/user/profile')),
                        array('label' => 'Войти', 'url' => array('/user/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Выход', 'url' => array('/user/logout'), 'visible' => !Yii::app()->user->isGuest)
                    ),
                ));
                ?>
            </div><!-- mainmenu -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

<?php echo $content; ?>

            <div class="clear"></div>

            <div id="footer">
                Идея: <b>Muravei</b>.<br/>
                Программирование: <b>Hitsi</b>.<br/>
                дизайнер разыскивается.<br/>
<?php echo Yii::powered(); ?><br/>
<!-- HotLog -->
<script type="text/javascript" language="javascript">
hotlog_js="1.0"; hotlog_r=""+Math.random()+"&s=2170420&im=614&r="+
escape(document.referrer)+"&pg="+escape(window.location.href);
</script>
<script type="text/javascript" language="javascript1.1">
hotlog_js="1.1"; hotlog_r+="&j="+(navigator.javaEnabled()?"Y":"N");
</script>
<script type="text/javascript" language="javascript1.2">
hotlog_js="1.2"; hotlog_r+="&wh="+screen.width+"x"+screen.height+"&px="+
(((navigator.appName.substring(0,3)=="Mic"))?screen.colorDepth:screen.pixelDepth);
</script>
<script type="text/javascript" language="javascript1.3">
hotlog_js="1.3";
</script>
<script type="text/javascript" language="javascript">
hotlog_r+="&js="+hotlog_js;
document.write('<a href="http://click.hotlog.ru/?2170420" target="_blank"><img '+
'src="http://hit39.hotlog.ru/cgi-bin/hotlog/count?'+
hotlog_r+'" border="0" width="88" height="31" alt="HotLog"><\/a>');
</script>
<noscript>
<a href="http://click.hotlog.ru/?2170420" target="_blank"><img
src="http://hit39.hotlog.ru/cgi-bin/hotlog/count?s=2170420&im=614" border="0"
width="88" height="31" alt="HotLog"></a>
</noscript>
<!-- /HotLog -->

<!--Openstat-->
<span id="openstat2198342"></span>
<script type="text/javascript">
var openstat = { counter: 2198342, image: 5084, color: "ff001c", next: openstat, track_links: "all" };
(function(d, t, p) {
var j = d.createElement(t); j.async = true; j.type = "text/javascript";
j.src = ("https:" == p ? "https:" : "http:") + "//openstat.net/cnt.js";
var s = d.getElementsByTagName(t)[0]; s.parentNode.insertBefore(j, s);
})(document, "script", document.location.protocol);
</script>
<!--/Openstat-->
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
