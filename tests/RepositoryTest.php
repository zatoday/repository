<?php
namespace ZAToday\Tests\Repositories;

use Mockery;
use PHPUnit\Framework\TestCase;

class RepositoryTest extends TestCase {

    protected $mock;

    public function setUp() {
        $this->mock = Mockery::mock('Illuminate\Database\Eloquent\Model');
    }
    public function testRepository()
    {
        $this->assertTrue(true);
    }
}
