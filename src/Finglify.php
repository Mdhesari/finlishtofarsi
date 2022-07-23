<?php

/**
 * This file is part of ammont/finglify.
 *
 * (c) Amir Montazer <ammontazer@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ammont\Finglify;

/**
 * Finglify
 *
 * @author    Amir Montazer <ammontazer@gmail.com>
 * @copyright 2012-2014 Amir Montazer
 * @license   http://www.opensource.org/licenses/MIT The MIT License
 */
class Finglify
{

    private $words_file_path;
    /** @var array */
    private $rules;

    public function __construct()
    {
        $this->words_file_path = __DIR__.'/../resources/words.json';

        $this->words_file_path = __DIR__.'/../resources/words.json';

        $this->rules[0] = array(
            'i'  => 'ای',
            'oo' => 'او',
        );

        $this->rules[1] = array(
            // Numeric characters
            1    => '۱',
            2    => '۲',
            3    => '۳',
            4    => '۴',
            5    => '۵',
            6    => '۶',
            7    => '۷',
            8    => '۸',
            9    => '۹',
            0    => '۰',

            /* Persian */
            'aa' => 'آ',
            'a'  => 'ا',
            'b'  => 'ب',
            'p'  => 'پ',
            't'  => 'ت',
            'j'  => 'ج',
            'ch' => 'چ',
            'kh' => 'خ',
            'd'  => 'د',
            'r'  => 'ر',
            'z'  => 'ز',
            's'  => 'س',
            'sh' => 'ش',
            'f'  => 'ف',
            'gh' => 'ق',
            'k'  => 'ک',
            'g'  => 'گ',
            'l'  => 'ل',
            'm'  => 'م',
            'n'  => 'ن',
            'v'  => 'و',
            'h'  => 'ه',
            'y'  => 'ی',
        );
    }

    public function translate($string)
    {
        $words = $this->parseWordsFromFile();

        $string = strlen(strtr($string, $words)) > 0 ? strtr($string, $words) : $string;

        foreach ($this->rules as $rule) {
            $string = strtr($string, $rule);
        }

        return $string;
    }

    public function parseWordsFromFile()
    {
        $words = file_get_contents($this->words_file_path);

        return json_decode($words, true);
    }

    public static function create()
    {
        return new static;
    }

    public static function trans($string)
    {
        return static::create()->translate($string);
    }
}
