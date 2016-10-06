<?php
namespace App\Contracts;

interface SuggestionsServiceInterface
{
    /**
     * Get hotels suggestions.
     * @param  string  $query
     * @param  integer $maxResults
     * @return SuggestionsServiceResponseInterface
     */
    public function hotels(string $query, int $maxResults = 10);

    /**
     * Get regions suggestions.
     * @param  string  $query
     * @param  integer $maxResults
     * @return SuggestionsServiceResponseInterface
     */
    public function regions(string $query, int $maxResults = 10);

    /**
     * Get flights suggestions.
     * @param  string  $query
     * @param  integer $maxResults
     * @return SuggestionsServiceResponseInterface
     */
    public function flights(string $query, int $maxResults = 10);
}
