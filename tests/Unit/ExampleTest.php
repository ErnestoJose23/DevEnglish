<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Topic;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_prueba_topic(){
        $topic = factory(Topic::class)->create();
    
        $this->assertEquals($topic->name, "Topic");
    }

}
