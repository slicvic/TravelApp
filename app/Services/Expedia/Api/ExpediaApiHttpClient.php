<?php
namespace App\Services\Expedia\Api;

use App\Services\Expedia\Api\Response\ExpediaApiRawResponse;

class ExpediaApiHttpClient
{
    /**
     * Perform HTTP GET request.
     * @param  string $url
     * @param  array  $data
     * @return ExpediaApiRawResponse
     */
    public function get(string $url, array $data)
    {
        $data['apikey'] = env('EXPEDIA_API_KEY');

        $response = new ExpediaApiRawResponse();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response->rawBody = curl_exec($ch);
        $response->body = json_decode($response->rawBody);
        $response->status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $response;
    }
}
