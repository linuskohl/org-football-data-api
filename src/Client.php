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
    const DEFAULT_REQUESTS_LEFT  = 100;
    const DEFAULT_TTRECOUP       = 86400;
    const DEFAULT_USER_AGENT     = "orgFootballDataApi";
    const DEFAULT_TIMEOUT        = 4.0;
    const CACHE_ENABLED          = true;
    const DEFAULT_CACHE_DURATION = 3600;
    const RESPONSE_FULL          = "full";
    const RESPONSE_MINIFIED      = "minified";
    const RESPONSE_COMPRESSED    = "compressed";
    
    /**
     *  @var string|null             $auth_token 
     *  @var \GuzzleHttp\Client|null $httpClient
     *  @var integer                 $requests_left
     * */
    private $auth_token;
    private $httpClient;
    private $jsonMapper;
    public  $requests_left;
    public  $ttRecoup;
    
    /**
     * Constructor
     * @param string $userid
     * @param string $password
     */
    public function __construct($auth_token = null) {
        $this->auth_token = $auth_token;
        $this->httpClient = new \GuzzleHttp\Client([
            'base_uri' => self::BASE_URL,
            'timeout'  => self::DEFAULT_TIMEOUT,
            'headers'  => [
                'X-Auth-Token' => $this->auth_token,
                'User-Agent'   => self::DEFAULT_USER_AGENT,
            ]
        ]);
        $this->jsonMapper = new \JsonMapper();
        $this->jsonMapper->bIgnoreVisibility = false;
        $this->jsonMapper->bEnforceMapType = false;
        $this->jsonMapper->bExceptionOnUndefinedProperty = false;
        $this->jsonMapper->bExceptionOnMissingData = false;
        
        // init requests left
        $this->requests_left = self::DEFAULT_REQUESTS_LEFT;
        $this->ttRecoup      = self::DEFAULT_TTRECOUP;
    }
    
    /**
     * 
     * @param integer $season
     * @param boolean $cached
     * @return \linuskohl\orgFootballDataApi\models\Competition[]|null
     */
    public function getCompetitions($season = null, $cached = true) 
    {
        $response = $this->get('competitions', $cached);
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
//        rawurlencode();
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
    
    protected function get($url, $cached = true) 
    {
        if($cached) {
            return $this->get_cached($url);
        } else {
            return $this->get_uncached($url);
        }
    }
    
    /**
    * 
    * @param unknown $url
    * @return unknown
    */
    protected function get_uncached($url) 
    {
        // send request
        $response = $this->httpClient->request('GET', $url, []);
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
        return $response->getBody()->getContents();
    }
    
    protected function get_cached($url)
    {
        $cache = \Yii::$app->cache;
        $data = $cache->get($url);
        if($data == false) {
            $data = $this->get_uncached($url);
            $cache->set($url, $data, self::DEFAULT_CACHE_DURATION);
        }
        return $data;
    }
        
}
