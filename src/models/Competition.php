<?php

namespace linuskohl\orgFootballDataApi\models;

use linuskohl\orgFootballDataApi\models\Link;

/**
 * Class Competition
 *
 * @package   linuskohl\orgFootballDataApi
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      https://github.com/linuskohl/orgFootballDataApi
 * @copyright 2017-2020 Linus Kohl
 */

class Competition 
{
    /** @var \linuskohl\orgFootballDataApi\models\Link[] */
    public $_links;   
    
    /** @var integer */
    public $id;
    
    /** @var string|null */
    public $caption;
    
    /** @var string|null */
    public $league;
    
    /** @var integer */
    public $year;
    
    /** @var integer|null */
    public $currentMatchday;
    
    /** @var integer|null */
    public $numberOfMatchdays;
    
    /** @var integer|null */
    public $numberOfTeams;
    
    /** @var integer|null */
    public $numberOfGames;
    
    /** @var string|null */
    public $lastUpdated;

}