<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChannelTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_channel_consist_of_threads()
    {
        $channel = create('App\Channel');

        $thread = create('App\Thread', ['channel_id' => $channel->id]);

        $this->assertTrue($channel->threads->contains($thread));

        // $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $channel->threads);
    }
}
