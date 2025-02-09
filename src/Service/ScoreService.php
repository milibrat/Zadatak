<?php

namespace App\Service;

class ScoreService
{
    public function calculateScore($word): int
    {
        $score = 0;
        $score = $this->isPalindrome($word);
        if ($score < 1) {
            $score = $this->almostPalindrome($word);
        }
        $score += $this->uniqueLetters($word);
        return $score;
    }

    public function isPalindrome($word): int
    {
        $reversedWord = strrev($word);
        return ($word === $reversedWord) ? 3 : 0;
    }

    public function almostPalindrome($word): int
    {
        for ($i = 0; $i <= strlen($word); $i++) {
            $new_string = substr_replace($word, '', $i, 1);
            $score = $this->isPalindrome($new_string);
            if ($score > 0) {
                return 2;
            }
        }
        return 0;
    }

    public function uniqueLetters($word): int
    {
        $letters = str_split($word);
        $letters = array_unique($letters);
        return count($letters);
    }
}