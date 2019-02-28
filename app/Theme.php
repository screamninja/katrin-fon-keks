<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Theme extends Model
{
    public $themes;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->themes = Config::get('bitwise');
    }

    public function getBitwise(int $bit): ?array
    {
        foreach ($this->themes as $binary => $themeName) {
            if ($bit & $binary) {
                $theme[] = $themeName;
            }
        }
        return $theme;
    }

    public function convertBitwise(array $ul): int
    {
        $bits = [];
        foreach ($this->themes as $binary => $names) {
            foreach ($ul as $li) {
                if ($li === $names) {
                    $bits[] = $binary;
                }
            }
        }
        $bin = array_reduce($bits, function ($x, $y) {
            return $x | $y;
        }, 0);
        return decbin($bin);
    }
}
