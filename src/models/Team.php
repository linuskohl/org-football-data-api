<?php

namespace linuskohl\orgFootballDataApi\models;

/**
 * Class Team
 *
 * @package   linuskohl\org-football-data-api
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      https://github.com/linuskohl/orgFootballDataApi
 * @copyright 2017-2020 Linus Kohl
 */

class Team
{

    /** @var integer */
    public $id;
    
    /** @var string */
    public $name;
    
    /** @var string|null */
    public $code;
    
    /** @var string|null */
    public $shortName;
    
    /** @var string|null */
    public $squadMarketValue;
    
    /** @var string|null */
    public $crestUrl;
    
}