<?php // Goto4ever.com
function GT4Elog($log = NULL, $file = "logs.log") //Add a logfile in root directory and write logs
{
    if ($log == NULL) {
        $log = GT4EgenerateCallTrace();
    }
    $fileopen=(fopen("$file",'a'));
    fwrite($fileopen, $today = date("Y-m-d H:i:s")." -> ".$log."\r\n"); // DATETIME + LOG
    fclose($fileopen);
}

function GT4EgenerateCallTrace() // From jurchiks101 at gmail dot com = Return something like that : 1) X:\www\backend\index.php(15): include('X:\\Tools\\wamp\\w...')
{
    $e = new Exception();
    $trace = explode("\n", $e->getTraceAsString());
    $trace = array_reverse($trace); // reverse array to make steps line up chronologically
    array_shift($trace); // remove {main}
    array_pop($trace); // remove call to this method
    $length = count($trace);
    $result = array();
    for ($i = 0; $i < $length; $i++)
    {
        $result[] = ($i + 1)  . ')' . substr($trace[$i], strpos($trace[$i], ' ')); // replace '#someNum' with '$i)', set the right ordering
    }
    return "\n\t" . implode("\n\t", $result);
}



function GT4EgetOS() {

    $user_agent     =   $_SERVER['HTTP_USER_AGENT'];

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
        '/windows nt 10/i'     =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );

    foreach ($os_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }

    return $os_platform;

}

function GT4EgetBrowser() {

    $user_agent     =   $_SERVER['HTTP_USER_AGENT'];

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
        '/msie/i'       =>  'Internet Explorer',
        '/firefox/i'    =>  'Firefox',
        '/safari/i'     =>  'Safari',
        '/chrome/i'     =>  'Chrome',
        '/edge/i'       =>  'Edge',
        '/opera/i'      =>  'Opera',
        '/netscape/i'   =>  'Netscape',
        '/maxthon/i'    =>  'Maxthon',
        '/konqueror/i'  =>  'Konqueror',
        '/mobile/i'     =>  'Handheld Browser'
    );

    foreach ($browser_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

}

function GT4EgetClient(){
    $user_os        =   GT4EgetOS();
    $user_browser   =   GT4EgetBrowser();
    $device_details =   $user_browser." On ".$user_os;
    return $device_details;
}