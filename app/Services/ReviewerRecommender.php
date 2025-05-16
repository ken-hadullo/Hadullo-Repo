<?php

namespace App\Services;

use App\Models\User;
use App\Models\Document;
use Illuminate\Support\Str;

class ReviewerRecommender
{
    // Define stop words
    protected static array $stopWords = [
        'the', 'and', 'for', 'with', 'a', 'an', 'to', 'in', 'on', 'of', 'is', 'are', 'this', 'that', 'by', 'at', 'as'
    ];

    // Define weights for each user field
    protected static array $fieldWeights = [
        'specialization' => 1,
        'education' => 1,
        'research_interests' => 2,
    ];

    /**
     * Match reviewers to a document based on keyword relevance.
     *
     * @param Document $document
     * @param int|null $limit Optional limit to number of results
     * @return array
     */
    public static function matchReviewers(Document $document, int $limit = null): array
    {
        $title = strtolower($document->proposal_title);

        // Fetch users from the same department
        $users = User::where('department_id', $document->department_id)->get();

        $recommendations = [];

        foreach ($users as $user) {
            $score = 0;

            $fields = [
                'specialization' => $user->specialization,
                'education' => $user->education,
                'research_interests' => $user->research_interests,
            ];

            foreach ($fields as $field => $value) {
                if ($value) {
                    $matchedWords = self::keywordMatch($title, $value);
                    $score += $matchedWords * self::$fieldWeights[$field];
                }
            }

            if ($score > 0) {
                $recommendations[] = [
                    'user' => $user,
                    'score' => $score,
                ];
            }
        }

        // Sort by score descending
        usort($recommendations, fn($a, $b) => $b['score'] <=> $a['score']);

        // Return limited results if limit is specified
        return $limit ? array_slice($recommendations, 0, $limit) : $recommendations;
    }

    /**
     * Preprocess a string: lowercase, remove punctuation, and filter stop words.
     *
     * @param string $text
     * @return array
     */
    protected static function preprocessText(string $text): array
    {
        $text = strtolower($text);
        $text = preg_replace('/[^\w\s]/', '', $text); // Remove punctuation
        $words = explode(' ', $text);

        return array_filter($words, function ($word) {
            return !in_array($word, self::$stopWords) && strlen($word) > 2;
        });
    }

    /**
     * Count keyword matches between title and a given text.
     *
     * @param string $title
     * @param string $text
     * @return int
     */
    public static function keywordMatch(string $title, string $text): int
    {
        $titleWords = self::preprocessText($title);
        $text = strtolower(preg_replace('/[^\w\s]/', '', $text));

        $matches = 0;

        foreach ($titleWords as $word) {
            if (strpos($text, $word) !== false) {
                $matches++;
            }
        }

        return $matches;
    }
}
