<?php
namespace App\Services\Expedia\Api;

use App\Services\Expedia\Api\Response\ExpediaApiResponse;

class ExpediaApiHttpClient
{
    /**
     * Perform HTTP GET request.
     * @param  string $url
     * @param  array  $data
     * @return ExpediaApiResponse
     */
    public function get(string $url, array $data)
    {
        $data['apikey'] = env('EXPEDIA_API_KEY');

        $response = new ExpediaApiResponse();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response->body = json_decode(curl_exec($ch));
        $response->status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $response;
    }
}
