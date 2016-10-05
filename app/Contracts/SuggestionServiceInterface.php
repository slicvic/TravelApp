<?php
namespace App\Contracts;

interface SuggestionServiceInterface
{
    /**
     * Get hotels suggestions.
     * @param  string  $query
     * @param  integer $maxResults
     * @return SuggestionServiceResponseInterface
     */
    public function hotels(string $query, int $maxResults = 10);

    /**
     * Get regions suggestions.
     * @param  string  $query
     * @param  integer $maxResults
     * @return SuggestionServiceResponseInterface
     */
    public function regions(string $query, int $maxResults = 10);

    /**
     * Get flights suggestions.
     * @param  string  $query
     * @param  integer $maxResults
     * @return SuggestionServiceResponseInterface
     */
    public function flights(string $query, int $maxResults = 10);
}
