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
    
    /** @var string */
    public $position;
    
    /** @var integer */
    public $jerseyNumber;
    
    /** @var string */
    public $dateOfBirth;
    
    /** @var string */
    public $nationality;
    
    /** @var string */
    public $contractUntil;
    
    /** @var string */
    public $marketValue;
}