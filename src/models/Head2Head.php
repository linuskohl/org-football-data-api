<?php
namespace linuskohl\orgFootballDataApi\models;

/**
 * Class Head2Head
 *
 * @package   linuskohl\orgFootballDataApi
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      https://github.com/linuskohl/orgFootballDataApi
 * @copyright 2017-2020 Linus Kohl
 */

class Head2Head
{

    /** @var string|null */
    public $timeFrameStart;
    
    /** @var string|null */
    public $timeFrameEnd;
    
    /** @var integer|null */
    public $homeTeamWins;
    
    /** @var integer|null */
    public $awayTeamWins;
    
    /** @var integer|null */
    public $draws;
    
    /** @var \linuskohl\orgFootballDataApi\models\Fixture|null */
    public $lastHomeWinHomeTeam;
    
    /** @var \linuskohl\orgFootballDataApi\models\Fixture|null */
    public $lastWinHomeTeam;
    
    /** @var \linuskohl\orgFootballDataApi\models\Fixture|null */
    public $lastAwayWinAwayTeam;
    
    /** @var \linuskohl\orgFootballDataApi\models\Fixture|null */
    public $lastWinAwayTeam;

    /** @var \linuskohl\orgFootballDataApi\models\Fixture[]|null */
    public $fixtures;
    
}
