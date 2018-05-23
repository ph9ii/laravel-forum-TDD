<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }

    /**
     * A user can see all threads.
     *
     */
    public function test_a_user_can_see_all_threads()
    {
        $this->get('/threads')
             ->assertSee($this->thread->title);
    }

    /**
     * A user can see a single threads.
     *
     */
    public function test_a_user_can_see_single_threads()
    {
        $this->get($this->thread->path())
             ->assertSee($this->thread->title);
    }

    /**
     * Given we have a thread
     * And that thread hav replies
     * When we visit a thread page
     * Then we should see the replies
     * 
     */
    public function test_a_user_can_read_replies()
    {
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
             ->assertSee($reply->body);   
    }

    public function test_a_user_can_filter_thread_according_to_channel()
    {
        // $this->withExceptionHandling();

        $channel = create('App\Channel');

        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);

        $threadNotInChannel = create('App\Thread');
        // dd('/threads/' . $channel->slug);
        $this->get('/threads/' . $channel->slug)
             ->assertSee($threadInChannel->title)
             ->assertDontSee($threadNotInChannel->title);
    }

    /** Threads by username filter */
    public function test_user_can_filter_threads_by_username()
    {
        $this->signIn(create('App\User', ['name' => 'JohnDoe']));

        $threadByJohn = create('App\Thread', ['user_id' => auth()->id()]);

        $threadNotByJohn = create('App\Thread');

        $this->get('threads?by=JohnDoe')
             ->assertSee($threadByJohn->title)
             ->assertDontSee($threadNotByJohn->title);
    }

    /**
     * A user can filter threads by popularity test.
     *
     * @return void
     */
    public function test_user_can_filter_threads_by_popularity()
    {
        $threadWithTwoReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithTwoReplies->id], 2);

        $threadWithThreeReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithThreeReplies->id], 3);

        $threadWithNoReplies = $this->thread;

        $response = $this->getJson('threads?popular=1')->json();

        $this->assertEquals([3, 2, 0], array_column($response, 'replies_count'));
    }
}
