<?php

namespace linuskohl\orgFootballDataApi;

use linuskohl\orgFootballDataApi\models\Competition;
use linuskohl\orgFootballDataApi\models\Team;
use linuskohl\orgFootballDataApi\models\Player;
use linuskohl\orgFootballDataApi\models\Fixture;
use linuskohl\orgFootballDataApi\models\LeagueTable;
use linuskohl\orgFootballDataApi\models\Standing;


/**
 * Class Client
 * 
 * @package   linuskohl\orgFootballDataApi;
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License 
 * @link      https://github.com/linuskohl/orgFootballDataApi
 * @copyright 2017-2020 Linus Kohl
 */

class Client
{
    /** Football-Data.org Base url */
    const BASE_URL = "https://api.football-data.org/v1/";
    
    const DEFAULT_USER_AGENT  = "orgFootballDataApi";
    const DEFAULT_TIMEOUT     = 2.0;
    
    const RESPONSE_FULL       = "full";
    const RESPONSE_MINIFIED   = "minified";
    const RESPONSE_COMPRESSED = "compressed";
    
    /**
     *  @var string|null             $auth_token 
     *  @var \GuzzleHttp\Client|null $httpClient
     *  @var integer                 $requests_left
     * */
    private $auth_token;
    private $httpClient;
    private $requests_left;
    
    /**
     * Constructor
     * @param string $userid
     * @param string $password
     */
    public function __construct($auth_token = null) {
        $this->auth_token = $auth_token;
        $this->httpClient = new GuzzleHttp\Client([
            'base_uri' => self::BASE_URL,
            'timeout'  => self::DEFAULT_TIMEOUT,
            'headers'  => [
                'X-Auth-Token' => $this->auth_token,
                'User-Agent'   => self::DEFAULT_USER_AGENT,
            ]
        ]);
    }
    
    /**
     * 
     * @param unknown $season
     */
    public function getCompetitions($season = null) 
    {
        
    }
    
    /**
     * 
     * @param integer $competition_id
     */
    public function getTeamsByCompetition($competition_id)
    {
        rawurlencode()
    }
    
    /**
     * 
     * @param integer $competition_id
     * @param unknown $matchday
     */
    public function getLeagueTable($competition_id, $matchday = null)
    {
        
    }
    
    /**
     * 
     * @param unknown $time_frame
     * @param unknown $matchday
     */
    public function getFixturesByCompetition($time_frame = null, $matchday = null)
    {
        
    }
    
    /**
     * 
     * @param unknown $time_frame
     * @param unknown $leagues
     */
    public function getFixtures($time_frame = null, $leagues = null)
    {
        
    }
    
    /**
     * 
     * @param integer $fixture_id
     */
    public function getFixture($fixture_id)
    {
        
    }
    
    /**
     * 
     * @param integer $team_id
     */
    public function getTeam($team_id)
    {
        
    }
    
    /**
     * 
     * @param integer $player_id
     */
    public function getPlayer($player_id) 
    {
        
    }
    
}