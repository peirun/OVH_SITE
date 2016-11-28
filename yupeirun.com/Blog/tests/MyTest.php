<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MyTest extends TestCase
{
  public function setUp(){
    parent::setUp();
  }
  //测试首页
  public function testIndex()
  {
    $this->call('GET', '/');
    $this->assertResponseOk();
    $this->see('articles');
    $this->see('tags');
  }
    //测试错误的url
  public function testNotFound()
  {
    $this->call('GET', 'test');
    $this->assertResponseStatus(404);
  }
    public function testExample()
    {
        $this->assertTrue(true);
    }
}
