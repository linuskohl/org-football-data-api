<?php

namespace linuskohl\orgFootballDataApi\models;

use \linuskohl\orgFootballDataApi\models\Result;

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
    
    const STATUS_SCHEDULED  = "SCHEDULED"; 
    const STATUS_CANCELED   = "CANCELED";
    const STATUS_TIMED      = "TIMED";
    const STATUS_IN_PLAY    = "IN_PLAY";
    const STATUS_POSTPONED  = "POSTPONED";
    const STATUS_FINISHED   = "FINISHED";
    
    /** @var integer */
    public $id;

    /** @var integer */
    public $competitionId;
    
    /** @var string */
    public $date;
    
    /** @var integer */
    public $matchday;
    
    /** @var string|null */
    public $status;
    
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
    
    /**
     * @param integer $cId
     */
    public function setCId($cId) 
    {
        $this->competitionId = $cId;
    }
    
    /**
     * @param string|null $stat
     */
    public function setStat($stat) 
    {
        $this->status = $stat;
    }
    
    /**
     * @param integer|null $mday
     */
    public function setMday($mday) 
    {
        $this->matchday = $mday;
    }
    
    /**
     * @param integer|null $htId
     */
    public function setHtId($htId) 
    {
        $this->homeTeamId = $htId;
    }
    
    /**
     * @param integer|null $atId
     */
    public function setAtId($atId) 
    {
        $this->awayTeamId = $atId;
    }
    
    /**
     * @param \linuskohl\orgFootballDataApi\models\Result $res
     */
    public function setRes($res) {
        $this->result = $res;
    }
    
    
}