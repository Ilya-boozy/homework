<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class WeatherService
{
    public static function get_weather (){
        $weather_key = config("weather.weather_key");
        $weather_lat = config("weather.weather_lat");
        $weather_lon = config("weather.weather_lon");
        $weather_api_url = "https://api.weather.yandex.ru/v2/forecast?lat=".$weather_lat."&lon=".$weather_lon;
        $request = Http::withHeaders(["X-Yandex-API-Key" => $weather_key])->get($weather_api_url);
        if ($request->successful()) {
            $request = $request->json();
        }
        return $request;
    }
}