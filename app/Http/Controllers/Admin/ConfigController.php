<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use ConfigCat\ConfigCatClient;
use ConfigCat\User;
use Illuminate\Http\Request;
use ConfigCat\ClientOptions;


class ConfigController extends Controller
{
    /**
     * @var ConfigCatClient
     */
    private $configCatClient;

    public function __construct(ConfigCatClient $configCatClient)
    {
        $this->configCatClient = $configCatClient;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function isAwesomeEnabled()
    {

        
        $client = new \ConfigCat\ConfigCatClient("lEXaCHSev0CKhaT19oJ0Gw/rwbcJQI--kixBUXZNErGKw", [ // <-- This is the actual SDK Key for your 'Test Environment' environment.
            \ConfigCat\ClientOptions::LOG_LEVEL => \ConfigCat\Log\LogLevel::INFO, // <-- Set the log level to INFO to track how your feature flags were evaluated. When moving to production, you can remove this line to avoid too detailed logging.
            \ConfigCat\ClientOptions::CACHE => new \ConfigCat\Cache\LaravelCache(\Illuminate\Support\Facades\Cache::store()),
            \ConfigCat\ClientOptions::CACHE_REFRESH_INTERVAL => 5,
         ]);

        $isMyFirstFeatureEnabled = $client->getValue("isMyFirstFeatureEnabled", false);
       
        
         return view('config',compact('isMyFirstFeatureEnabled'));
        
    }

    public function isPOCEnabled(Request $request)
    {
        return response()->json($this->configCatClient->getValue("isPOCFeatureEnabled", false, new User("#SOME-USER-ID#", $request->email)));
    }
}