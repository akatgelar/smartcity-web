<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AppHelper
{
    public static function instance()
    {
        return new AppHelper();
    }

    function requestApiSetting() {
        try {
            $res_data = [];
            $req = Request::create('api/setting', 'GET');
            $res = Route::dispatch($req);
            $res_json = json_decode($res->getContent(), true);
            if ($res_json['status'] == true) {
                foreach ($res_json['data'] as $row) {
                    $res_data[$row['key']] = $row['value'];
                }
            } else {
                error_log($res_json['message']);
            }
            return $res_data;
        }
        catch (\Exception $e) {
            return [];
        }
    }

    function getMinioImage($path) {
        try {
            $expirationTime = now()->addMinutes(5);
            $temporaryUrl = Storage::disk('minio')->temporaryUrl($path, $expirationTime);
            return $temporaryUrl;
        }
        catch (\Exception $e) {
            return $path;
        }
    }

    function sendMail($to, $subject, $payload) {
        try {
            $from = env('MAIL_FROM_ADDRESS');
            Mail::html($payload, function($data) use($from, $to, $subject) {
                $data->from($from, 'Smart City App');
                $data->to($to);
                $data->subject($subject);
            });
            return [1, 'Email send success'];
        } catch (Exception $ex) {
            return [0, $ex->getMessage()];
        }
    }


    function convertDateTimeIndo($date_string) {
		setlocale(LC_TIME, 'IND');
        $date_format = new Carbon($date_string);
		return $date_format->formatLocalized('%d %B %Y %H:%M:%S');
    }

    function convertDateIndo($date_string) {
		setlocale(LC_TIME, 'IND');
        $date_format = new Carbon($date_string);
		return $date_format->formatLocalized('%d %B %Y');
    }

    function convertMonthIndo($date_string) {
		setlocale(LC_TIME, 'IND');
        $date_format = new Carbon($date_string);
		return $date_format->formatLocalized('%B %Y');
    }

    function getOS($user_agent) {

        $os_platform  = "Unknown OS Platform";
        $os_array     = array(
            '/windows nt 10/i'      =>  'Windows 10',
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

        foreach ($os_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $os_platform = $value;

        return $os_platform;
    }

    function getBrowser($user_agent) {

        $browser        = "Unknown Browser";
        $browser_array = array(
            '/msie/i'      => 'Internet Explorer',
            '/firefox/i'   => 'Firefox',
            '/safari/i'    => 'Safari',
            '/chrome/i'    => 'Chrome',
            '/edge/i'      => 'Edge',
            '/opera/i'     => 'Opera',
            '/netscape/i'  => 'Netscape',
            '/maxthon/i'   => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i'    => 'Handheld Browser'
        );

        foreach ($browser_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $browser = $value;

        return $browser;
    }

    function createLogs($routeName, $routePath) {
        $status = 0;
        logger('WebLogs class is running:');
        logger([$routeName,$routePath]);
        // Save to database here
        // ...
        return $status;
    }

}


