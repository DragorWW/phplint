<?php

namespace PhpLint;

class StringHelper
{
    /**
     * Returns true if the specified string is in the camel caps format.
     *
     * @package   PHP_CodeSniffer
     * @author    Greg Sherwood <gsherwood@squiz.net>
     * @author    Marc McIntyre <mmcintyre@squiz.net>
     * @copyright 2006-2014 Squiz Pty Ltd (ABN 77 084 670 600)
     * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
     * @link      http://pear.php.net/package/PHP_CodeSniffer
     *
     * @param string $string The string the verify.
     * @param boolean $classFormat If true, check to see if the string is in the
     *                             class format. Class format strings must start
     *                             with a capital letter and contain no
     *                             underscores.
     * @param boolean $public If true, the first character in the string
     *                             must be an a-z character. If false, the
     *                             character must be an underscore. This
     *                             argument is only applicable if $classFormat
     *                             is false.
     * @param boolean $strict If true, the string must not have two capital
     *                             letters next to each other. If false, a
     *                             relaxed camel caps policy is used to allow
     *                             for acronyms.
     *
     * @return boolean
     */
    public static function isCamelCaps(
        $string,
        $classFormat = false,
        $public = true,
        $strict = true
    )
    {
        // Check the first character first.
        if ($classFormat === false) {
            $legalFirstChar = '';
            if ($public === false) {
                $legalFirstChar = '[_]';
            }
            if ($strict === false) {
                // Can either start with a lowercase letter, or multiple uppercase
                // in a row, representing an acronym.
                $legalFirstChar .= '([A-Z]{2,}|[a-z])';
            } else {
                $legalFirstChar .= '[a-z]';
            }
        } else {
            $legalFirstChar = '[A-Z]';
        }
        if (preg_match("/^$legalFirstChar/", $string) === 0) {
            return false;
        }
        // Check that the name only contains legal characters.
        $legalChars = 'a-zA-Z0-9';
        if (preg_match("|[^$legalChars]|", substr($string, 1)) > 0) {
            return false;
        }
        if ($strict === true) {
            // Check that there are not two capital letters next to each other.
            $length = strlen($string);
            $lastCharWasCaps = $classFormat;
            for ($i = 1; $i < $length; $i++) {
                $ascii = ord($string{$i});
                if ($ascii >= 48 && $ascii <= 57) {
                    // The character is a number, so it cant be a capital.
                    $isCaps = false;
                } else {
                    if (strtoupper($string{$i}) === $string{$i}) {
                        $isCaps = true;
                    } else {
                        $isCaps = false;
                    }
                }
                if ($isCaps === true && $lastCharWasCaps === true) {
                    return false;
                }
                $lastCharWasCaps = $isCaps;
            }
        }//end if
        return true;
    }

    /**
     * Returns true if the specified string is in the underscore caps format.
     *
     * @package   PHP_CodeSniffer
     * @author    Greg Sherwood <gsherwood@squiz.net>
     * @author    Marc McIntyre <mmcintyre@squiz.net>
     * @copyright 2006-2014 Squiz Pty Ltd (ABN 77 084 670 600)
     * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
     * @link      http://pear.php.net/package/PHP_CodeSniffer
     *
     * @param string $string The string to verify.
     *
     * @return boolean
     */
    public static function isUnderscoreName($string)
    {
        // If there are space in the name, it can't be valid.
        if (strpos($string, ' ') !== false) {
            return false;
        }
        $validName = true;
        $nameBits = explode('_', $string);
        if (preg_match('|^[A-Z]|', $string) === 0) {
            // Name does not begin with a capital letter.
            $validName = false;
        } else {
            foreach ($nameBits as $bit) {
                if ($bit === '') {
                    continue;
                }
                if ($bit{0} !== strtoupper($bit{0})) {
                    $validName = false;
                    break;
                }
            }
        }
        return $validName;
    }

    public static function isMagicMethod($name)
    {
        $magicMethods = [
            '__construct',
            '__destruct',
            '__call',
            '__callstatic',
            '__get',
            '__set',
            '__isset',
            '__unset',
            '__sleep',
            '__wakeup',
            '__tostring',
            '__set_state',
            '__clone',
            '__invoke',
            '__debuginfo',
        ];
        return in_array($name, $magicMethods);
    }
}