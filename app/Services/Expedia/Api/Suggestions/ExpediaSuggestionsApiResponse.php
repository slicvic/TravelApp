<?php
namespace App\Services\Expedia\Api\Suggestions;

use App\Services\Expedia\Api\ExpediaApiAbstractResponse;

class ExpediaSuggestionsApiResponse extends ExpediaApiAbstractResponse
{
    /**
     * The search results.
     * @var array
     */
    protected $results;

    /**
     * {@inheritdoc}
     */
    public function __construct($data, $status = 200)
    {
        parent::__construct($data, $status);

        $this->setResults();
    }
    /**
     * Get the search results.
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Extract and normalize actual search results from response data.
     */
    private function setResults()
    {
        $this->results = [];

        if (!(!empty($this->data['rc']) && $this->data['rc'] == 'OK' && !empty($this->data['sr']))) {
            return;
        }

        foreach ($this->data['sr'] as $row) {
            $row['d'] = str_replace(['<B>', '</B>'], ['', ''], $row['d']);
            $this->results[] = $row;
        }
    }
}
