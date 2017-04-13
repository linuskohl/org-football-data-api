<?php
namespace linuskohl\orgFootballDataApi\models;

class Standing
{
    /** @var integer */
    public $rank;
    
    /** @var string */
    public $team;
    
    /** @var integer */
    public $teamId;
    
    /** @var integer */
    public $playedGames;
    
    /** @var string */
    public $crestURI;
    
    /** @var integer */
    public $points;
    
    /** @var integer */
    public $goals;
    
    /** @var integer */
    public $goalsAgainst;
    
    /** @var integer */
    public $goalDifference;    
}