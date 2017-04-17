<?php

namespace linuskohl\orgFootballDataApi\models;

/**
 * Class Result
 *
 * @package   linuskohl\orgFootballDataApi
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      https://github.com/linuskohl/orgFootballDataApi
 * @copyright 2017-2020 Linus Kohl
 */

class Result
{
    /** @var integer|null */
    public $goalsHomeTeam;
    
    /** @var integer|null */
    public $goalsAwayTeam;
    
    /** @var \linuskohl\orgFootballDataApi\models\Result|null */
    public $halfTime;
    
    /** @var \linuskohl\orgFootballDataApi\models\Result|null */
    public $extraTime;
    
    /** @var \linuskohl\orgFootballDataApi\models\Result|null */
    public $penaltyShootout;
    
    /**
     * @param integer|null $ght
     */
    public function setGht($ght)
    {
        $this->goalsHomeTeam = $ght;
    }
    
    /**
     * @param integer|null $aht
     */
    public function setAht($gat)
    {
        $this->goalsAwayTeam = $gat;
    }
    
}