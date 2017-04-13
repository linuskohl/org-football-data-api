<?php

namespace linuskohl\orgFootballDataApi\models;

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
    /** @var integer */
    public $id;
    
    /** @var string|null */
    public $caption;
    
    /** @var string|null */
    public $league;
    
    /** @var integer */
    public $year;
    
    /** @var integer */
    public $numberOfTeams;
    
    /** @var integer */
    public $numberOfGames;
    
    /** @var DateTime */
    public $lastUpdated;

}