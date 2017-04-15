# orgFootballDataApi

Unofficial Football-Data.org PHP API client<br>
Documentation available [here](http://api.football-data.org/documentation) and [here](http://api.football-data.org/docs/v1/index.html).<br>
Able to serialize responses to custom models via JSON mapper.<br>

![soccer](https://images.pexels.com/photos/17598/pexels-photo.jpg?w=1260&h=750&auto=compress&cs=tinysrgb "")

## Requirements
-  "guzzlehttp/guzzle": "^6.2"
-  "netresearch/jsonmapper": "~1.1.1"


## Install

Via Composer

``` bash
$ composer require linuskohl/org-football-data-api dev-master
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://github.com/linuskohl

## Documentation
### Class: \linuskohl\orgFootballDataApi\Client
| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$auth_token=null</strong>)</strong> : <em>void</em><br /><em>Constructor</em> |
| public | <strong>getCompetitions(</strong><em>integer</em> <strong>$season=null</strong>, <em>bool/boolean</em> <strong>$cached=true</strong>)</strong> : <em>[\linuskohl\orgFootballDataApi\models\Competition](#class-linuskohlorgfootballdataapimodelscompetition)[]/null</em> |
| public | <strong>getCompetitionsRaw(</strong><em>integer</em> <strong>$season=null</strong>, <em>bool/boolean</em> <strong>$cached=true</strong>)</strong> : <em>mixed</em> |
| public | <strong>getFixture(</strong><em>integer</em> <strong>$fixture_id</strong>, <em>integer</em> <strong>$head2head=10</strong>, <em>bool/boolean</em> <strong>$cached=true</strong>)</strong> : <em>[\linuskohl\orgFootballDataApi\models\Fixture](#class-linuskohlorgfootballdataapimodelsfixture)</em><br /><em>Get fixture by id</em> |
| public | <strong>getFixtureRaw(</strong><em>integer</em> <strong>$fixture_id</strong>, <em>integer</em> <strong>$head2head=10</strong>, <em>bool/boolean</em> <strong>$cached=true</strong>)</strong> : <em>mixed</em><br /><em>Get fixture by id</em> |
| public | <strong>getFixtures(</strong><em>string</em> <strong>$time_frame=null</strong>, <em>string[]</em> <strong>$leagues=null</strong>, <em>bool/boolean</em> <strong>$cached=true</strong>)</strong> : <em>[\linuskohl\orgFootballDataApi\models\Fixture](#class-linuskohlorgfootballdataapimodelsfixture)[]</em><br /><em>Get fixtures</em> |
| public | <strong>getFixturesByCompetition(</strong><em>mixed</em> <strong>$competition_id</strong>, <em>string</em> <strong>$time_frame=null</strong>, <em>integer</em> <strong>$matchday=null</strong>, <em>bool/boolean</em> <strong>$cached=true</strong>)</strong> : <em>[\linuskohl\orgFootballDataApi\models\Fixture](#class-linuskohlorgfootballdataapimodelsfixture)[]</em> |
| public | <strong>getFixturesByCompetitionRaw(</strong><em>mixed</em> <strong>$competition_id</strong>, <em>string</em> <strong>$time_frame=null</strong>, <em>integer</em> <strong>$matchday=null</strong>, <em>bool/boolean</em> <strong>$cached=true</strong>)</strong> : <em>mixed</em> |
| public | <strong>getFixturesByTeam(</strong><em>mixed</em> <strong>$team_id</strong>, <em>integer</em> <strong>$season=null</strong>, <em>string</em> <strong>$time_frame=null</strong>, <em>string</em> <strong>$venue=null</strong>, <em>bool/boolean</em> <strong>$cached=true</strong>)</strong> : <em>[\linuskohl\orgFootballDataApi\models\Fixture](#class-linuskohlorgfootballdataapimodelsfixture)[]</em> |
| public | <strong>getFixturesByTeamRaw(</strong><em>mixed</em> <strong>$team_id</strong>, <em>integer</em> <strong>$season=null</strong>, <em>string</em> <strong>$time_frame=null</strong>, <em>string</em> <strong>$venue=null</strong>, <em>bool/boolean</em> <strong>$cached=true</strong>)</strong> : <em>mixed</em> |
| public | <strong>getFixturesRaw(</strong><em>string</em> <strong>$time_frame=null</strong>, <em>string[]</em> <strong>$leagues=null</strong>, <em>bool/boolean</em> <strong>$cached=true</strong>)</strong> : <em>mixed</em><br /><em>Get fixtures</em> |
| public | <strong>getLeagueTable(</strong><em>integer</em> <strong>$competition_id</strong>, <em>\linuskohl\orgFootballDataApi\unknown</em> <strong>$matchday=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>getPlayer(</strong><em>integer</em> <strong>$team_id</strong>, <em>bool/boolean</em> <strong>$cached=true</strong>)</strong> : <em>[\linuskohl\orgFootballDataApi\models\Player](#class-linuskohlorgfootballdataapimodelsplayer)[]</em><br /><em>Get list of all players of a team</em> |
| public | <strong>getPlayerRaw(</strong><em>integer</em> <strong>$team_id</strong>, <em>bool/boolean</em> <strong>$cached=true</strong>)</strong> : <em>mixed</em><br /><em>Get list of all players of a team</em> |
| public | <strong>getTeam(</strong><em>integer</em> <strong>$team_id</strong>, <em>bool/boolean</em> <strong>$cached=true</strong>)</strong> : <em>[\linuskohl\orgFootballDataApi\models\Team](#class-linuskohlorgfootballdataapimodelsteam)</em><br /><em>Get team object</em> |
| public | <strong>getTeamRaw(</strong><em>integer</em> <strong>$team_id</strong>, <em>bool/boolean</em> <strong>$cached=true</strong>)</strong> : <em>mixed</em><br /><em>Get team object</em> |
| public | <strong>getTeamsByCompetition(</strong><em>integer</em> <strong>$competition_id</strong>, <em>bool/boolean</em> <strong>$cached=true</strong>)</strong> : <em>[\linuskohl\orgFootballDataApi\models\Team](#class-linuskohlorgfootballdataapimodelsteam)[]</em> |
| public | <strong>getTeamsByCompetitionRaw(</strong><em>integer</em> <strong>$competition_id</strong>, <em>bool/boolean</em> <strong>$cached=true</strong>)</strong> : <em>mixed</em> |
| public | <strong>setCache(</strong><em>mixed</em> <strong>$cache</strong>)</strong> : <em>void</em> |
| protected static | <strong>generateCacheKey(</strong><em>string</em> <strong>$url</strong>, <em>mixed</em> <strong>$parameters</strong>)</strong> : <em>string</em><br /><em>Generate a key to cache the query</em> |
| protected | <strong>get(</strong><em>string</em> <strong>$url</strong>, <em>array/mixed[]</em> <strong>$parameters=array()</strong>, <em>bool/boolean</em> <strong>$cached=true</strong>)</strong> : <em>string</em><br /><em>Get data from API or cache</em> |
| protected | <strong>sendRequest(</strong><em>string</em> <strong>$url</strong>, <em>mixed[]</em> <strong>$parameters</strong>)</strong> : <em>string</em><br /><em>Send request to API</em> |
<hr /> 



## Additional Documentation
### League Codes
League-Code | Country | League
---|:---:|------:
BL1| Germany |1. Bundesliga 
BL2|Germany|2. Bundesliga
BL3 |Germany|3. Bundesliga
DFB|Germany|Dfb-Cup
PL|England|Premiere League
EL1|England|League One
ELC|England|Championship
FAC|England|FA-Cup
SA|Italy|Serie A|
SB|Italy|Serie B
PD|Spain|Primera Division
SD|Spain|Segunda Division
CDR|Spain|Copa del Rey
FL1|France|Ligue 1
FL2|France|Ligue 2
DED|Netherlands|Eredivisie
PPL|Portugal|Primeira Liga
GSL|Greece|Super League
CL|Europe|Champions-League
EL|Europe|UEFA-Cup
EC|Europe|European-Cup of Nations
WC|World|World-Cup
