<?php

namespace linuskohl\orgFootballDataApi\models;

/**
 * Class Fixture
 *
 * @package   linuskohl\orgFootballDataApi
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      https://github.com/linuskohl/orgFootballDataApi
 * @copyright 2017-2020 Linus Kohl
 */

class Fixture
{
    
    /** @var integer */
    public $id;

    /** @var integer */
    public $competitionId;
    
    /** @var string */
    public $date;
    
    /** @var integer */
    public $matchday;
    
    /** @var string */
    public $homeTeamName;
    
    /** @var integer */
    public $homeTeamId;
    
    /** @var string */
    public $awayTeamName;
    
    /** @var integer */
    public $awayTeamId;
    
    /** @var \linuskohl\orgFootballDataApi\models\Result */
    public $result;
    
}