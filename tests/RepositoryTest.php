<?php
namespace ZAToday\Tests\Repositories;
use \Mockery as m;
use \PHPUnit_Framework_TestCase as TestCase;
class RepositoryTest extends TestCase {
    public function setUp() {
        $this->mock = m::mock('Illuminate\Database\Eloquent\Model');
    }
    public function testRepository()
    {
        $this->assertTrue(true);
    }
}
