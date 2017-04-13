<?php
namespace linuskohl\orgFootballDataApi\models;

class LeagueTable
{
    /** @var string */
    public $leagueCaption;
    
    /** @var integer */
    public $matchday;
    
    /** @var linuskohl\orgFootballDataApi\models\Standing[] */
    public $standing;
    
}