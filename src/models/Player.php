<?php

namespace linuskohl\orgFootballDataApi\models;

/**
 * Class Player
 * 
 * @package   linuskohl\orgFootballDataApi
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License 
 * @link      https://github.com/linuskohl/orgFootballDataApi
 * @copyright 2017-2020 Linus Kohl
 */

class Player
{
    /** @var integer */
    public $id;
    
    /** @var string */
    public $name;
    
    /** @var string|null */
    public $position;
    
    /** @var integer|null */
    public $jerseyNumber;
    
    /** @var string|null */
    public $dateOfBirth;
    
    /** @var string|null */
    public $nationality;
    
    /** @var string|null */
    public $contractUntil;
    
    /** @var string|null */
    public $marketValue;
    
}