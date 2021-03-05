<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {

        $this->assertTrue(true); // 要素true
        $this->assertFalse(false); // 要素false

        $this->assertEquals(100, 100); // 値が同じ
        $this->assertNotEquals(100, 101); // 値が同じではない

        $arr = '';
        $this->assertEmpty($arr); // 要素が空orNull
        $this->assertNull(null); // 要素が空orNull

        $arr = [1,2,3];
        $this->assertNotEmpty($arr); // 要素が空orNullではない
        $this->assertNotNull($arr); // 要素が空orNull

        $msg = "Hello";
        $this->assertEquals('Hello', $msg); //要素が同じ


        $n = random_int(0, 99);
        $this->assertLessThan(100, $n); // 100 > $n
        $this->assertLessThanorEqual(100, 100); // 100 >= $n
        $this->assertGreaterThan($n, 100); // 100 < $n
        $this->assertGreaterThanorEqual(100, 100); // 100 <= $n

        $this->assertStringStartsWith('a','abcdef'); // aで始まる文字
        $this->assertStringEndsWith('f','abcdef'); // fで終わる文字

        $response = $this->get('/'); // ルートにアクセス
        $response->assertStatus(302); // 200ステータスであること
    }
}
