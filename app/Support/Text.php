<?php

namespace App\Support;

use Illuminate\Support\HtmlString;

class Text
{
    public static function rich(?string $text): HtmlString
    {
        $text = str_replace(["\r\n", "\r"], "\n", trim((string) $text));

        if ($text === '') {
            return new HtmlString('');
        }

        $html = '';
        $para = [];
        $poem = [];

        $flushPara = function () use (&$html, &$para) {
            if ($para) {
                $html .= '<p>' . implode('<br>', array_map('e', $para)) . '</p>';
                $para = [];
            }
        };

        $flushPoem = function () use (&$html, &$poem) {
            while ($poem && end($poem) === '') array_pop($poem);
            while ($poem && $poem[0] === '') array_shift($poem);

            if ($poem) {
                $html .= '<blockquote class="poem">' . implode('<br>', array_map('e', $poem)) . '</blockquote>';
            }
            $poem = [];
        };

        foreach (explode("\n", $text) as $line) {
            $t = trim($line);

            if (str_starts_with($t, '>')) {
                $flushPara();
                $poem[] = ltrim(mb_substr($t, 1));
            } elseif ($t === '') {
                $flushPara();
                $flushPoem();
            } else {
                $flushPoem();
                $para[] = $t;
            }
        }

        $flushPara();
        $flushPoem();

        return new HtmlString($html);
    }
}
