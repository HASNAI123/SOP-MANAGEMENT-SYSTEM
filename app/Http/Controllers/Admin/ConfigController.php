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
        $client = new \ConfigCat\ConfigCatClient("lEXaCHSev0CKhaT19oJ0Gw/rwbcJQI--kixBUXZNErGKw");
        $isMyAwesomeFeatureEnabled = $client->getValue("isMyFirstFeatureEnabled", false);
        if(is_bool($isMyAwesomeFeatureEnabled) && $isMyAwesomeFeatureEnabled) {
           dd("YES SWITCH IS ON");
        } else {
           dd("SWITCH IS OFF");
        }
    }

    public function isPOCEnabled(Request $request)
    {
        return response()->json($this->configCatClient->getValue("isPOCFeatureEnabled", false, new User("#SOME-USER-ID#", $request->email)));
    }
}