<?php
namespace App\Contracts;

interface SuggestionServiceResponseInterface
{
    /**
     * Get results.
     * @return array
     */
    public function getResults();
}
