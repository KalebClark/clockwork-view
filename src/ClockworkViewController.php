<?php

namespace KalebClark\ClockworkView;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Guzzle;

use App\Http\Requests;

class ClockworkViewController extends Controller
{

    public $server;
    public $route;
    public $ignore;

    public function __construct()
    {
        $this->server = "http://mac.laradev";
        $this->route = "__clockwork-index";

        $this->ignore = [
            '\/vendor',
            '\/clockwork-show',
            '\/__clockwork-index',
            '\/js\/',
            '\/css\/'
        ];
    }

    public function checkMatches($needle, $haystack) {
        foreach($haystack as $match)
        {
            if(preg_match("/".$match."/", $needle)) {
                return false;
            }
        }
        return true;
    }

    public function show()
    {
        $dir = new \DirectoryIterator(base_path().'/storage/clockwork');

        $files = [];
        foreach($dir as $fileInfo)
        {
            // Only match json files
            if (!$fileInfo->isDot() && preg_match('/json/', $fileInfo->getFileName())) {

                $json = json_decode(file_get_contents($fileInfo->getPathname()));
                $mtime = $fileInfo->getMTime();
                $htime = date('Y-m-d H:i:s', $mtime);
                $json->htime = $htime;

                if($this->checkMatches($json->uri, $this->ignore))
                {
                    array_push($files, [
                        'id'        => preg_replace('/\.json$/', '', $fileInfo->getFileName()),
                        'time'      => $htime,
                        'method'    => $json->method,
                        'uri'       => parse_url($json->uri, PHP_URL_PATH)
                    ]);
                }

            }
        }
        ksort($files, SORT_ASC);
        $files = array_reverse($files,false);

        return view('clockworkview::index')->with('data', $files);
    }
}
