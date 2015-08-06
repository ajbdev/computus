<?php
/**
 * Created by PhpStorm.
 * User: andybaird
 * Date: 8/6/15
 * Time: 4:58 PM
 */

namespace Computus\Calendar;


class QueryLexer
{
    protected $tokenMap = array(

    );

    protected function getRegex() {
        return '((' . implode(')|(', array_keys($this->tokenMap)) . '))A';
    }

    // Read: http://jwage.com/post/31623163785/writing-a-parser-in-php-with-the-help-of-doctrine
    public function lex($string) {
        $regex = $this->getRegex();
        $offsetToToken = array_values($this->tokenMap);

        $offset = 0;
        while (isset($string[$offset])) {
            if (!preg_match($regex, $string, $matches, null, $offset)) {
                throw new \Exception(sprintf('Unexpected character "%s"', $string[$offset]));
            }

            for ($i = 1; '' === $matches[$i]; ++$i);

            $tokens[] = array($matches[0], $offsetToToken[$i - 1]);

            $offset += strlen($matches[0]);
        }

        return $tokens;
    }
}