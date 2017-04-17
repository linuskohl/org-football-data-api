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

class FixtureResponse
{
    /** @var \linuskohl\orgFootballDataApi\models\Fixture|null */
    public $fixture;
    
    /** @var \linuskohl\orgFootballDataApi\models\Head2Head|null */
    public $head2head;
    
}