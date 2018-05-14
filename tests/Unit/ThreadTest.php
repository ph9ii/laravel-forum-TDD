<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }

    public function test_thread_has_creator()
    {
        // Belongs to App\User relation
        $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    public function test_thread_has_a_string_path()
    {
        $thread = create('App\Thread');

        $this->assertEquals("threads/{$thread->channel->slug}/{$thread->id}", $thread->path());
    }

    public function test_thread_has_replies()
    {
        // Has many relation to App\Reply
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    public function test_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1,
        ]);

        $this->assertCount(1, $this->thread->replies);
    }

    public function test_thread_belongs_to_channel()
    {
        $thread = create('App\Thread');

        $this->assertInstanceOf('App\Channel', $thread->channel);
    }
}
