<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Unauth users may not add replies.
     *
     * @return void
     */
    public function test_unauthenticated_user_may_not_add_replies()
    {
        // $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->withExceptionHandling()
             ->post('/threads/channel-slug/1/replies', [])
             ->assertRedirect('/login');
    }

    /**
     * Participate in forum.
     *
     * @return void
     */
    public function test_authenticated_user_may_participate_in_forum_threads()
    {
        // Given that we hve an auth user
        $this->be($user = factory('App\User')->create());

        // And an existing thread
        $thread = create('App\Thread');

        // When the user adds a reply to the thread
        $reply = make('App\Reply');
        $this->post($thread->path() . '/replies', $reply->toArray());

        // Then the reply should be visible in the thread page
        // dd($thread->path());
        $this->get($thread->path())
             ->assertSee($reply->body);
    }

    public function test_reply_requires_body()
    {
        $this->withExceptionHandling()->signIn();

        // And an existing thread
        $thread = create('App\Thread');

        // When the user adds a reply to the thread
        $reply = make('App\Reply', ['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
             ->assertSessionHasErrors('body');
    }
}
