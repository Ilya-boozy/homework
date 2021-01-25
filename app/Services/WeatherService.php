<?php


namespace App\Services;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    const YANDEX_API = 'https://api.weather.yandex.ru/v2/informers';

    /**
     * @var $weather \Illuminate\Support\Collection
     */
    protected $weather;

    public function __construct()
    {
        $this->weather = collect(config("weather"));
    }

    public function get_weather()
    {
        $response = Http::withoutVerifying()
            ->withHeaders(["X-Yandex-API-Key" => $this->weather->get('key')])
            ->get(self::YANDEX_API, $this->weather->except('key')->toArray());
        if ($response->successful()) {
            $response = $response->json();

            return "temperature in Bryansk is " . Arr::get($response, "fact.temp");
        }

        return "can't get temperature";
    }
}