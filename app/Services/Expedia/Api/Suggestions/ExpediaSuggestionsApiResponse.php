<?php
namespace App\Services\Expedia\Api\Suggestions;

use App\Services\Expedia\Api\ExpediaApiAbstractResponse;

class ExpediaSuggestionsApiResponse extends ExpediaApiAbstractResponse
{
    /**
     * The search results.
     * 
     * @var array
     */
    protected $results;

    /**
     * {@inheritdoc}
     */
    public function __construct($body, $status = 200)
    {
        parent::__construct($body, $status);

        $this->setResults();
    }

    /**
     * Get search results.
     *
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Extract and prepare search results from body.
     */
    private function setResults()
    {
        $this->results = [];

        if (!(!empty($this->decodedBody['rc']) && $this->decodedBody['rc'] == 'OK' && !empty($this->decodedBody['sr']))) {
            return;
        }

        foreach ($this->decodedBody['sr'] as $row) {
            $row['d'] = str_replace(['<B>', '</B>'], ['', ''], $row['d']);
            $this->results[] = $row;
        }
    }
}
