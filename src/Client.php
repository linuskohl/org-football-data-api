<?php

namespace linuskohl\orgFootballDataApi;

use linuskohl\orgFootballDataApi\models\Competition;
use linuskohl\orgFootballDataApi\models\Team;
use linuskohl\orgFootballDataApi\models\Player;
use linuskohl\orgFootballDataApi\models\Fixture;
use linuskohl\orgFootballDataApi\models\LeagueTable;
use linuskohl\orgFootballDataApi\models\Standing;
use linuskohl\orgFootballDataApi\models\Link;
use linuskohl\orgFootballDataApi\models\Head2Head;
use linuskohl\orgFootballDataApi\models\FixtureResponse;


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
    
    const DEFAULT_REQUESTS_LEFT  = 50;
    const DEFAULT_TTRECOUP       = 60;

    const DEFAULT_USER_AGENT     = "orgFootballDataApi";
    const CACHE_ENABLED          = true;
    const DEFAULT_TIMEOUT        = 4.0;
    const DEFAULT_CACHE_DURATION = 3600;
    
    const RESPONSE_FULL          = "full";
    const RESPONSE_MINIFIED      = "minified";
    const RESPONSE_COMPRESSED    = "compressed";
    
    const REGEXP_VALID_TIMEFRAME = "/^[pn][1-9]{1,2}$/u";
    const REGEXP_VALID_VENUE     = "/^(home|away)$/u";
    const REGEXP_VALID_LEAGUE    = "/^[\w\d]{2,4}$/";
    
    
    /**
     *  @var string|null             $auth_token 
     *  @var \GuzzleHttp\Client|null $httpClient
     *  @var \JsonMapper|null        $jsonMapper
     *  @var mixed                   $cache
     *  @var integer                 $requests_left
     *  @var integer                 $ttRecoup
     * */
    private $auth_token;
    private $httpClient;
    private $jsonMapper;
    private $cache;
    public  $requests_left;
    public  $ttRecoup;
    
    
    /**
     * Constructor
     * 
     * @param string $auth_token
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
     * @param  integer $season
     * @param  boolean $cached
     * @return \linuskohl\orgFootballDataApi\models\Competition[]|null
     * @throws \Exception
     */
    public function getCompetitions($season = null, $cached = true) 
    {
        $competitions = $this->getCompetitionsRaw($season, $cached);
        $res = array();
        if(is_array($competitions)) {
            foreach($competitions as $competition) {
                array_push($res, $this->jsonMapper->map($competition, new Competition()));
            }
        }
        return $res;
    }

    /**
     *
     * @param integer $season
     * @param boolean $cached
     * @return mixed
     * @throws \Exception
     */
    public function getCompetitionsRaw($season = null, $cached = true)
    {
        $query_string = 'competitions/';
        $params = array();
        $request_params = ['headers' => [self::HEADER_RESPONSE_CONT => self::RESPONSE_MINIFIED]];
        if(is_int($season)) {
            $params["season"] = $season;
        }
        $query_string .= "?".http_build_query($params);
        $response = $this->get($query_string, $request_params, $cached);
        $competitions = json_decode($response, true);
        return $competitions;
    }
    
    
    /**
     * 
     * @param  integer $competition_id
     * @param  boolean $cached
     * @return \linuskohl\orgFootballDataApi\models\Team[]
     */
    public function getTeamsByCompetition($competition_id, $cached = true)
    {
        $teams_response = $this->getTeamsByCompetitionRaw($competition_id, $cached);
        $res = array();
        if(is_array($teams_response)) {
            foreach($teams_response["teams"] as $team) {
                array_push($res, $this->jsonMapper->map($team, new Team()));
            }
        }
        return $res;
    }
    
    /**
     *
     * @param  integer $competition_id
     * @param  boolean $cached
     * @return mixed
     */
    public function getTeamsByCompetitionRaw($competition_id, $cached = true)
    {
        if(is_int($competition_id)) {
            $query_string = 'competitions/'.$competition_id.'/teams';
            $parameters = array();
            $parameters = ['headers' => [self::HEADER_RESPONSE_CONT => self::RESPONSE_MINIFIED]];
            $response = $this->get($query_string, $parameters, $cached);
            $teams = json_decode($response, true);
            return $teams;
        } 
    }
    
    /**
     * 
     * @param integer $competition_id
     * @param unknown $matchday
     */
    public function getLeagueTable($competition_id, $matchday = null)
    {
       // TODO:
    }
    
    /**
     * @param  integer $competition_id
     * @param  string  $time_frame
     * @param  integer $matchday
     * @param  boolean $cached
     * @return \linuskohl\orgFootballDataApi\models\Fixture[]
     */
    public function getFixturesByCompetition($competition_id, $time_frame = null, $matchday = null, $cached = true)
    {
        
        $fixtures_response = $this->getFixturesByCompetitionRaw($competition_id, $time_frame, $matchday, $cached);
        $res = array();
        if(is_array($fixtures_response["fixtures"])) {
            foreach($fixtures_response["fixtures"] as $fixture) {
                array_push($res, $this->jsonMapper->map($fixture, new Fixture()));
            }
        }
        return $res;
    }
    
    /**
     * @param  integer $competition_id
     * @param  string  $time_frame
     * @param  integer $matchday
     * @param  boolean $cached
     * @return mixed
     * @throws \Exception
     */
    public function getFixturesByCompetitionRaw($competition_id, $time_frame = null, $matchday = null, $cached = true)
    {
        if(is_int($competition_id)) {
            $query_string = 'competitions/'.$competition_id.'/fixtures';
            $params = array();
            $request_params = ['headers' => [self::HEADER_RESPONSE_CONT => self::RESPONSE_MINIFIED]];
            if(!empty($time_frame) && preg_match(self::REGEXP_VALID_TIMEFRAME,$time_frame)) {
                $params["timeFrame"] = $time_frame;
            }
            if(is_int($matchday)) {
                $params["matchday"] = $matchday;
            }
            $query_string .= "?".http_build_query($params);
            $response = $this->get($query_string, $request_params, $cached);
            $fixtures = json_decode($response,true);
            return $fixtures;
        }
    }
    
    /**
     * 
     * @param  integer $team_id
     * @param  integer $season
     * @param  string  $time_frame
     * @param  string  $venue
     * @param  boolean $cached
     * @return \linuskohl\orgFootballDataApi\models\Fixture[]
     * @throws \Exception
     */
    public function getFixturesByTeam($team_id, $season = null, $time_frame = null, $venue = null, $cached = true)
    {
        $fixtures_response = $this->getFixturesByTeamRaw($team_id, $season, $time_frame, $venue, $cached);
        $res = array();
        if(is_array($fixtures_response["fixtures"])) {
            foreach($fixtures_response["fixtures"] as $fixture) {
                array_push($res, $this->jsonMapper->map($fixture, new Fixture()));
            }
        }
        return $res;
    }
    
    /**
     * @param  integer $team_id
     * @param  integer $season
     * @param  string  $time_frame
     * @param  string  $venue
     * @param  boolean $cached
     * @return mixed
     * @throws \Exception
     */
    public function getFixturesByTeamRaw($team_id, $season = null, $time_frame = null, $venue = null, $cached = true)
    {
        if(is_int($team_id)) {
            $query_string = 'teams/'.$team_id.'/fixtures';
            $params = array();
            $request_params= ['headers' => [self::HEADER_RESPONSE_CONT => self::RESPONSE_MINIFIED]];
            if(is_int($season)) {
                $params["season"] = $season;
            }
            if(!empty($time_frame) && preg_match(self::REGEXP_VALID_TIMEFRAME, $time_frame)) {
                $params["timeFrame"] = $time_frame;
            }
            if(!empty($venue) && preg_match(self::REGEXP_VALID_VENUE, $venue)) {
                $params["venue"] = $venue;
            }
            $query_string .= "?".http_build_query($params);
            $response = $this->get($query_string, $request_params, $cached);
            $fixtures = json_decode($response, true);
            return $fixtures;
        }
    }
 
    /**
     * Get fixtures
     *
     * @param  string    $time_frame
     * @param  string[]  $leagues
     * @param  boolean   $cached
     * @return \linuskohl\orgFootballDataApi\models\Fixture[]
     * @throws \Exception
     */
    public function getFixtures($time_frame = null, $leagues = null, $cached = true)
    {
        $fixtures_response = $this->getFixturesRaw($time_frame, $leagues, $cached);
        $res = array();
        if(is_array($fixtures_response["fixtures"])) {
            foreach($fixtures_response["fixtures"] as $fixture) {
                array_push($res, $this->jsonMapper->map($fixture, new Fixture()));
            }
        }
        return $res;
    }
    
    /**
     * Get fixtures
     *
     * @param  string    $time_frame
     * @param  string[]  $leagues
     * @param  boolean   $cached
     * @return mixed
     * @throws \Exception
     */
    public function getFixturesRaw($time_frame = null, $leagues = null, $cached = true)
    {
        $query_string = 'fixtures';
        
        //$request_params = ['headers' => [self::HEADER_RESPONSE_CONT => self::RESPONSE_COMPRESSED]];
        $params = array();
        
        // add timeFrame
        if(!empty($time_frame) && preg_match(self::REGEXP_VALID_TIMEFRAME, $time_frame)) {
            $params["timeFrame"] = $time_frame;
        }
        
        // add leagues to request
        if(!empty($leagues)) {
            $leagues_filtered = preg_grep(self::REGEXP_VALID_LEAGUE, $leagues);
            $params["leagues"] = implode (",", $leagues_filtered);
        }
        $query_string .= "?".http_build_query($params);
        
        $response = $this->get($query_string, $request_params, $cached);
        $fixtures = json_decode($response, true);
        return $fixtures;
    }
    
    /**
     * Get fixture by id
     * 
     * @param  integer $fixture_id
     * @param  integer $head2head
     * @param  boolean $cached
     * @return \linuskohl\orgFootballDataApi\models\FixtureResponse|null
     * @throws \Exception
     */
    public function getFixture($fixture_id, $head2head = 10, $cached = true)
    {
        $fixture = $this->getFixtureRaw($fixture_id, $head2head, $cached);
        return $this->jsonMapper->map($fixture, new FixtureResponse());
    }
    
    /**
     * Get fixture by id
     *
     * @param  integer $fixture_id
     * @param  integer $head2head
     * @param  boolean $cached
     * @return mixed
     * @throws \Exception
     */
    public function getFixtureRaw($fixture_id, $head2head = 10, $cached = true)
    {
        $cached = false;
        if(is_numeric($fixture_id)) {
            $query_string = 'fixtures/'.$fixture_id;
            $params = array();
            $request_params = ['headers' => [self::HEADER_RESPONSE_CONT => self::RESPONSE_MINIFIED]];
            if(is_int($head2head)) {
                $params["head2head"] = $head2head;
            }
            $query_string .= "?".http_build_query($params);
            $response = $this->get($query_string, $request_params, $cached);
            $fixture = json_decode($response, true);
            return $fixture;
        }
    }
    
    /**
     * Get team object
     * 
     * @param  integer $team_id
     * @param  boolean $cached
     * @return \linuskohl\orgFootballDataApi\models\Team
     * @throws \Exception
     */
    public function getTeam($team_id, $cached = true)
    {
        $team = $this->getTeamRaw($team_id, $cached);
        return $this->jsonMapper->map($team, new Team());
    }
    
    /**
     * Get team object
     *
     * @param  integer $team_id
     * @param  boolean $cached
     * @return mixed
     * @throws \Exception
     */
    public function getTeamRaw($team_id, $cached = true)
    {
        $parameters = ['headers' => [self::HEADER_RESPONSE_CONT => self::RESPONSE_MINIFIED]];
        if(is_int($team_id)) {
            $query_string = 'teams/'.$team_id;
            $response = $this->get($query_string, $parameters, $cached);
            $team = json_decode($response, true);
            return $team;
        }
    }
    
    /**
     * Get list of all players of a team
     * 
     * @param  integer $team_id
     * @param  boolean $cached
     * @return \linuskohl\orgFootballDataApi\models\Player[]
     * @throws \Exception
     */
    public function getPlayer($team_id, $cached = true) 
    {
        $players_response = $this->getPlayerRaw($team_id, $cached);
        $res = array();
        if(is_array($players_response["players"] )) {
            foreach($players_response["players"] as $player) {
                array_push($res, $this->jsonMapper->map($player, new Player()));
            }
        }
        return $res;
    }
    
    /**
     * Get list of all players of a team
     *
     * @param  integer $team_id
     * @param  boolean $cached
     * @return mixed 
     * @throws \Exception
     */
    public function getPlayerRaw($team_id, $cached = true)
    {
        if(is_int($team_id)) {
            $parameters = ['headers' => [self::HEADER_RESPONSE_CONT => self::RESPONSE_MINIFIED]];
            $query_string = '/v1/teams/'.$team_id.'/players';
            $response = $this->get($query_string, $parameters, $cached);
            $players = json_decode($response, true);
            return $players;
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
    * Send request to API
    * 
    * @param  string  $url
    * @param  mixed[] $parameters
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
     * Get data from API or cache 
     *
     * @param  string  $url
     * @param  mixed[] $parameters
     * @param  boolean $cached
     * @return string
     * @throws \Exception
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
     * @param  string $url
     * @param  mixed  $parameters
     * @return string
     */
    protected static function generateCacheKey($url, $parameters) 
    {
        return $url.json_encode($parameters);
    }
        
}
