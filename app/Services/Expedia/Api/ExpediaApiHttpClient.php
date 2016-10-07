<?php
namespace App\Services\Expedia\Api;

use App\Services\Expedia\Api\ExpediaApiResponse;
use App\Services\Expedia\Api\ExpediaApiAbstractRequestParameters;

class ExpediaApiHttpClient
{
    /**
     * Perform HTTP GET request.
     * @param  string $url
     * @param  ExpediaApiAbstractRequestParameters $data
     * @return ExpediaApiResponse
     */
    public function get(string $url, ExpediaApiAbstractRequestParameters $parameters)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . '?' . $parameters->toQueryString());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $response = new ExpediaApiResponse($data, $status);

        return $response;
    }
}
