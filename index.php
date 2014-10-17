<?php

//exit("aa");

//ini_set('display_errors', true);
//ini_set('error_reporting', E_ALL);

//var_dump($_SERVER);exit;
if (preg_match('/^\/[a-zA-Z0-9]{16}\&/', $_SERVER['REQUEST_URI'])) {
    $_SERVER['REQUEST_URI'][17] = '?';
    $_SERVER['SCRIPT_NAME'][17] = '?';

}
//var_dump($_SERVER);exit;


$__CONSUME__ = array('total' => 0, 'picasso' => array(), 'cassandra' => array(), 'to_mp3' => array(), 'mysql' => array());
$_beginTime = microtime(true);
require 'QFrameSmarty/Loader.php';
require 'auto_load.php';
$webApp = QFrame::createWebApp();
$webApp->throwException(QFrameConfig::getConfig('EXCEPTION'));
//?Զ???ControllerPath
//$webApp->setControllerPath('/home/lizhenyang/txl/360txl/trunk/src/application/controllers/');
//$webApp->setViewPath('/home/lizhenyang/txl/360txl/trunk/src/application/views/');

/*
 * ?Զ???·?ɹ???
 */


$GLOBALS['LOG'] = QFrameConfig::getConfig('CLOG_CONFIG');
$userupload = new QFrameRouteRegex(
    'upload_new\.php',
    array(
        'controller' => 'msg',
        'action' => 'upload',
    ),
    array('1' => 'filename',
    )
);

$userdown = new QFrameRouteRegex(
    '([a-zA-Z0-9]{16})[\.]*',
    array(
        'controller' => 'download',
        'action' => 'download',
    ),
    array('1' => 'src',
    )
);

$voice_userdown = new QFrameRouteRegex(
    '([a-zA-Z0-9]{18})[\.]*',
    array(
        'controller' => 'download',
        'action' => 'download',
    ),
    array('1' => 'src',
    )
);

$sms_view = new QFrameRouteRegex(
    '([a-zA-Z0-9]{8})[\.]*',
    array(
        'controller' => 'sms',
        'action' => 'view',
    ),
    array('1' => 'msg',
    )
);
$group_view = new QFrameRouteRegex(
    'g/([a-zA-Z0-9]{8})[\.]*',
    array(
        'controller' => 'sms',
        'action' => 'group_view',
    ),
    array('1' => 'sc',
    )
);

$head_photodown = new QFrameRouteRegex(
    '([a-zA-Z0-9]{14})[\.]*',
    array(
        'controller' => 'percenter',
        'action' => 'down',
    ),
    array('1' => 'src',
    )
);

/*	
	$userdownb = new QFrameRouteRegex(
       '([a-zA-Z0-9]{16})[\.]*',
       array(
              'controller' => 'msg',
              'action'     => 'download',
       ),
       array('1'=>'src',
       )
     );*/

$userstat = new QFrameRouteRegex(
    'txl_stat\.php',
    array(
        'controller' => 'index',
        'action' => 'txlstat',
    ),
    array('1' => 'src',
    )
);
$userreg = new QFrameRouteRegex(
    'smsreg\/dialer_reg',
    array(
        'controller' => 'user',
        'action' => 'reg',
    )
);
$userfeed = new QFrameRouteRegex(
    'user_feedback\.php',
    array(
        'controller' => 'index',
        'action' => 'feedback',
    )
);

$res = QFrameContainer::find('QFrameRouter')->addRoute('useru', $userupload);
$res = QFrameContainer::find('QFrameRouter')->addRoute('userd', $userdown);
$res = QFrameContainer::find('QFrameRouter')->addRoute('v_userd', $voice_userdown);
//$res= QFrameContainer::find('QFrameRouter')->addRoute('userdb',$userdownb);
$res = QFrameContainer::find('QFrameRouter')->addRoute('users', $userstat);
$res = QFrameContainer::find('QFrameRouter')->addRoute('userreg', $userreg);
$res = QFrameContainer::find('QFrameRouter')->addRoute('userfeed', $userfeed);
$res = QFrameContainer::find('QFrameRouter')->addRoute('h_userd', $head_photodown);
$res = QFrameContainer::find('QFrameRouter')->addRoute('sms_view', $sms_view);
$res = QFrameContainer::find('QFrameRouter')->addRoute('group_view', $group_view);

header("Content-Type:text/html;charset=utf-8");
$webApp->run();


$_endTime = microtime(true);

$__CONSUME__['total'] = (int)round(($_endTime - $_beginTime) * 1000, 1);
$__CONSUME__['picasso'] = join(",", $__CONSUME__['picasso']);
$__CONSUME__['cassandra'] = join(",", $__CONSUME__['cassandra']);
$__CONSUME__['to_mp3'] = join(",", $__CONSUME__['to_mp3']);
$__CONSUME__['mysql'] = join(",", $__CONSUME__['mysql']);
$__CONSUME_LOG__ = array();
ksort($__CONSUME__);

foreach ($__CONSUME__ as $k => $v) {
    $__CONSUME_LOG__[] = '[' . $k . ']' . $v;
}
$__CONSUME_LOG__ = join(" ", $__CONSUME_LOG__);
error_log(date("Y-m-d.H:i:s", time()) . " " . $__CONSUME_LOG__ . " " . $_SERVER['REQUEST_URI'] . "\n", 3, QFrameConfig::getConfig('ROOT_PATH') . 'logs/consume/' . date("Ymd", time()) . '.log');
?>
