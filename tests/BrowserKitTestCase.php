<?php

namespace Tests;

use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class BrowserKitTestCase extends BaseTestCase
{
    use CreatesApplication, CreatesUsers;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    public $baseUrl = 'http://larahah';
}
