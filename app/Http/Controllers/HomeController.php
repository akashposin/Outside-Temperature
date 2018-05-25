<?php

namespace App\Http\Controllers;

use App\Helpers\WeatherApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        try
        {
	        $weather_api = new WeatherApi();
	        $weather_data=$weather_api->getCurrentWeatherByIP();
        }
        catch (\Exception $e)
		{
			if($request->ajax())
            {
	            return Response::json(array(
			        'success' => false,
			        'error' => $e->getMessage()

			    ), 200); //422

            }
			return view('home-index')->with('error',$e->getMessage());

        }

        return view('home-index')->with('weather_data',$weather_data);
    }
}
