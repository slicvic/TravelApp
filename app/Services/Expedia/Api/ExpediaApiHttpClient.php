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
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: expedia-apikey key=' . env('EXPEDIA_API_KEY')
        ));
        $data = curl_exec($ch);
        $headers = curl_getinfo($ch);
        curl_close($ch);

        $response = new ExpediaApiResponse($data, $headers['http_code']);

        return $response;
    }
}
