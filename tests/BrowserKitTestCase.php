<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class BrowserKitTestCase extends BaseTestCase
{
    use CreatesApplication, CreatesUsers;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://larahah';
}
