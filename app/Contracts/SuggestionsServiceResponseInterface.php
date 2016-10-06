<?php
namespace App\Contracts;

interface SuggestionsServiceResponseInterface
{
    /**
     * Get results.
     * @return array
     */
    public function getResults();
}
