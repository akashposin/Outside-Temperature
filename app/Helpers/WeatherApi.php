<?php namespace App\Helpers;

class WeatherApi {

	protected $api_key;
	protected $api_url;

	public function __construct()
    {
        $this->api_key=env('WEATHER_API_KEY','');

        $this->api_url="http://api.apixu.com/v1" ;
    }

	public function getCurrentWeatherByIP()
    {
        $ip=\Request::getClientIp();
	    $url = $this->api_url."/current.json?key=".$this->api_key."&q=".urlencode($ip)."&=" ;

	    $ch = curl_init();
	    curl_setopt($ch,CURLOPT_URL,$url);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

	    $json_output=curl_exec($ch);
	    $weather = json_decode($json_output);

	    if(isset($weather->error))
		{
			if($weather->error->code==1002)
			{
				throw new \Exception($weather->error->message." .env file must have variable WEATHER_API_KEY=YOUR_API_KEY");
			}
			throw new \Exception($weather->error->message);
		}

		return $weather;
    }

}