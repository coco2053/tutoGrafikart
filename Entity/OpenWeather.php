<?php


class OpenWeather
{
    private $key;
    const FORECAST_URL = 'api.openweathermap.org/data/2.5/forecast?q=';

    public function __construct(String $key)
    {
        $this->key = $key;
    }

    public function getForecast(String $city)
    {
        $curl = curl_init(Self::FORECAST_URL . $city . '&cnt=5&units=metric&lang=fr&appid=' . $this->key);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        if($data === false) {
           throw new Exception(curl_error($curl));
        }
        if(curl_getinfo($curl, CURLINFO_HTTP_CODE) != 200) {
            throw new Exception($data);
        }
        $data = json_decode($data, true);
        $results = [];
        foreach($data['list'] as $day) {
            $results [] = [
                'temp' => $day['main']['temp'],
                'description' => $day['weather'][0]['description'],
                'date' => new DateTime('@' . $day['dt'])
            ];
        }
        curl_close($curl);
        return $results;
    }
}