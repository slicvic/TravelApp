<?php
namespace App\Services\Expedia\Api;

use App\Services\Expedia\Api\Response\ExpediaApiGenericResponse;

class ExpediaApiHttpClient
{
    /**
     * Perform HTTP GET request.
     * @param  string $url
     * @param  array  $data
     * @return ExpediaApiGenericResponse
     */
    public function get(string $url, array $data)
    {
        $data['apikey'] = env('EXPEDIA_API_KEY');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseBody = curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $response = new ExpediaApiGenericResponse($responseCode, $responseBody);

        return $response;
    }
}
