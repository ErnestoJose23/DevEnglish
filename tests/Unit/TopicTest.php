<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class TopicTest extends TestCase
{
    /** @test */
    public function create_test(){
        $topic = factory(App\Topic::class)->make();


    }
}
