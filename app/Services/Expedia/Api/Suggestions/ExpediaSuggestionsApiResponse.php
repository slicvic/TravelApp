<?php
namespace App\Services\Expedia\Api\Suggestions;

use App\Services\Expedia\Api\ExpediaApiAbstractResponse;

class ExpediaSuggestionsApiResponse extends ExpediaApiAbstractResponse
{
    /**
     * The original response data.
     * @var array
     */
    protected $originalData;

    /**
     * Get the original data.
     * @return array
     */
    public function getOriginalData()
    {
        return $this->originalData;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setData($data)
    {
        parent::setData($data);

        // Save original data
        $this->originalData = $this->data;

        // Make data the actual search results
        $this->data = [];

        if (!(!empty($data['rc']) && $data['rc'] == 'OK' && !empty($data['sr']))) {
            return $this;
        }

        foreach ($data['sr'] as $result) {
            $result['d'] = str_replace(['<B>', '</B>'], ['', ''], $result['d']);
            $this->data[] = $result;
        }

        return $this;
    }
}
