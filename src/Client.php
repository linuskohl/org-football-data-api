<?php

namespace linuskohl\orgFootballDataApi;

use linuskohl\orgFootballDataApi\models\Competition;
use linuskohl\orgFootballDataApi\models\Team;
use linuskohl\orgFootballDataApi\models\Player;
use linuskohl\orgFootballDataApi\models\Fixture;
use linuskohl\orgFootballDataApi\models\LeagueTable;
use linuskohl\orgFootballDataApi\models\Standing;
use linuskohl\orgFootballDataApi\models\Link;


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
    const BASE_URL               = "https://api.football-data.org/v1/";
    const HEADER_RATE_LIMIT      = "X-Requests-Available";
    const HEADER_COUNTER_RESET   = "X-RequestCounter-Reset";
    const HEADER_RESPONSE_CONT   = "X-Response-Control";
    const DEFAULT_REQUESTS_LEFT  = 100;
    const DEFAULT_TTRECOUP       = 86400;
    const DEFAULT_USER_AGENT     = "orgFootballDataApi";
    const DEFAULT_TIMEOUT        = 4.0;
    const CACHE_ENABLED          = true;
    const DEFAULT_CACHE_DURATION = 3600;
    const RESPONSE_FULL          = "full";
    const RESPONSE_MINIFIED      = "minified";
    const RESPONSE_COMPRESSED    = "compressed";
    const REGEXP_VALID_TIMEFRAME = "/^[pn][1-9]{1,2}$/u";
    const REGEXP_VALID_VENUE     = "/^(home|away)$/u";
    
    
    /**
     *  @var string|null             $auth_token 
     *  @var \GuzzleHttp\Client|null $httpClient
     *  @var integer                 $requests_left
     * */
    private $auth_token;
    private $httpClient;
    private $jsonMapper;
    private $cache;
    public  $requests_left;
    public  $ttRecoup;
    
    
    /**
     * Constructor
     * @param string $userid
     * @param string $password
     */
    public function __construct($auth_token = null) {
        $this->auth_token = $auth_token;
        
        // initialize the HTTP client
        $this->httpClient = new \GuzzleHttp\Client([
            'base_uri' => self::BASE_URL,
            'timeout'  => self::DEFAULT_TIMEOUT,
            'headers'  => [
                'X-Auth-Token'       => $this->auth_token,
                'User-Agent'         => self::DEFAULT_USER_AGENT,
                //'X-Response-Control' => 'compressed',
            ]
        ]);
        
        // initialize the JSON Mapper
        $this->jsonMapper = new \JsonMapper();
        $this->jsonMapper->bIgnoreVisibility = false;
        $this->jsonMapper->bEnforceMapType = false;
        $this->jsonMapper->bExceptionOnUndefinedProperty = false;
        $this->jsonMapper->bExceptionOnMissingData = false;
        
        // init counters
        $this->requests_left = self::DEFAULT_REQUESTS_LEFT;
        $this->ttRecoup      = self::DEFAULT_TTRECOUP;
    }
    
    /**
     * 
     * @param integer $season
     * @param boolean $cached
     * @return \linuskohl\orgFootballDataApi\models\Competition[]|null
     * @throws \Exception
     */
    public function getCompetitions($season = null, $cached = true) 
    {
        $query_string = 'competitions/';
        $parameters = array();
        if(is_int($season)) {
            $parameters["season"] = $season;
        }
        $response = $this->get('competitions', $parameters, $cached);
        $competitions = json_decode($response);
        $res = array();
        foreach($competitions as $competition) {
            array_push($res, $this->jsonMapper->map($competition, new Competition()));
        }
        return $res;
    }
    
    /**
     * 
     * @param integer $competition_id
     */
    public function getTeamsByCompetition($competition_id)
    {
        
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
     * @param integer $id
     * @param string  $time_frame
     * @param integer $matchday
     * @param boolean $cached
     */
    public function getFixturesByCompetition($competition_id, $time_frame = null, $matchday = null, $cached = true)
    {
        if(is_int($competition_id)) {
            $query_string = 'competitions/'.$competition_id.'/fixtures';
            $parameters = array();
            
            if(!empty($time_frame) && preg_match(self::REGEXP_VALID_TIMEFRAME,$time_frame)) {
                $parameters["timeFrame"] = $time_frame;
            }
            if(is_int($matchday)) {
                $parameters["matchday"] = $matchday;
            }
            
            $response = $this->get($query_string, $parameters, $cached);
            $fixtures = json_decode($response);
            $res = array();
           
            foreach($fixtures->fixtures as $fixture) {
                
                array_push($res, $this->jsonMapper->map($fixture, new Fixture()));
            }
            return $res;
        }
    }
    
    /**
     * 
     * @param unknown $time_frame
     * @param unknown $leagues
     */
    public function getFixturesByTeam($team_id, $season = null, $time_frame = null, $venue = null, $cached = true)
    {
        if(is_int($team_id)) {
            $query_string = 'teams/'.$team_id.'/fixtures';
            $parameters = array();
            $parameters = ['headers' => [self::HEADER_RESPONSE_CONT => 'compressed']];
            if(is_int($season)) {
                $parameters["season"] = $season;
            }
            if(!empty($time_frame) && preg_match(self::REGEXP_VALID_TIMEFRAME, $time_frame)) {
                $parameters["timeFrame"] = $time_frame;
            }
            if(!empty($venue) && preg_match(self::REGEXP_VALID_VENUE, $venue)) {
                $parameters["venue"] = $venue;
            }
            $response = $this->get($query_string, $parameters, $cached);
            $fixtures = json_decode($response);
            $res = array();
            
            foreach($fixtures->fixtures as $fixture) {
                array_push($res, $this->jsonMapper->map($fixture, new Fixture()));
            }
            return $res;
        }
    }
    
    /**
     * 
     * @param integer $fixture_id
     * @param integer $head2head
     * @param boolean $cached
     */
    public function getFixture($fixture_id, $head2head = 10, $cached = true)
    {
        if(is_int($fixture_id)) {
            $query_string = 'fixtures/'.$fixture_id;
            $parameters = array();
            $parameters = ['headers' => [self::HEADER_RESPONSE_CONT => 'compressed']];
            if(is_int($head2head)) {
                $parameters["head2head"] = $head2head;
            }
            $response = $this->get($query_string, $parameters, $cached);
            $fixtures = json_decode($response);
            $res = array();
            
            foreach($fixtures->fixtures as $fixture) {
                
                array_push($res, $this->jsonMapper->map($fixture, new Fixture()));
            }
            return $res;
        }
    }
    
    /**
     * 
     * @param integer $team_id
     * @param boolean $cached
     */
    public function getTeam($team_id, $cached = true)
    {
        $parameters = ['headers' => [self::HEADER_RESPONSE_CONT => self::RESPONSE_MINIFIED]];
        if(is_int($team_id)) {
            $query_string = 'teams/'.$team_id;
            $response = $this->get($query_string, $parameters, $cached);
            $team = json_decode($response);            
            return $this->jsonMapper->map($team, new Team());
        }
    }
    
    /**
     * 
     * @param integer $team_id
     * @param boolean $cached
     */
    public function getPlayer($team_id, $cached = true) 
    {
        if(is_int($team_id)) {
            $parameters = ['headers' => [self::HEADER_RESPONSE_CONT => self::RESPONSE_MINIFIED]];
            $query_string = '/v1/teams/'.$team_id.'/players';
            $response = $this->get($query_string, $parameters, $cached);
            $players = json_decode($response);
            $res = array();
            foreach($players->players as $player) {
                array_push($res, $this->jsonMapper->map($player, new Player()));
            }
            return $res;
        }
    }
    
    /**
     *
     * @param mixed $cache
     */
    public function setCache($cache) 
    {
        $this->cache = $cache;    
    }
    
    /**
    * 
    * @param string $url
    * @param mixed[] $parameters
    * @return string
    */
    protected function sendRequest($url, $parameters) 
    {
        // send request
        $response = $this->httpClient->request('GET', $url, $parameters);
        
        // update requests left
        $req_left = $response->getHeader(self::HEADER_RATE_LIMIT);
        if(count($req_left) > 0 && is_numeric($req_left[0])) {
            $this->requests_left = $req_left[0];
        }
        
        // update time till reset of requests
        $ttrecoup = $response->getHeader(self::HEADER_COUNTER_RESET);
        if(count($ttrecoup) > 0 && is_numeric($ttrecoup[0])) {
            $this->ttRecoup = $ttrecoup[0];
        }
        return (string)$response->getBody()->getContents();
    }
    
    /**
     * Get data
     *
     * @param string $url
     * @param mixed[] $parameters
     * @return string
     */
    protected function get($url, $parameters = [], $cached = true)
    {
        if(isset($this->cache)) {
            $key = self::generateCacheKey($url, $parameters);
            if($cached) {
                $data = $this->cache->get($key);
                if($data !== false) {
                    return $data;
                }
            }
            $data = $this->sendRequest($url, $parameters);
            $this->cache->set($key, $data, self::DEFAULT_CACHE_DURATION);
            return $data;
        } else {
            return $this->sendRequest($url, $parameters);
        }
    }
    
    /**
     * Generate a key to cache the query
     * 
     * @param string $url
     * @param mixed $parameters
     * @return string
     */
    protected static function generateCacheKey($url, $parameters) 
    {
        return $url.json_encode($parameters);
    }
        
}
