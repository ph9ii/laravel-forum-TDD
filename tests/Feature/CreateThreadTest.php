<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * guest user can not create threads.
     *
     * @return void
     */
    public function test_guest_user_can_not_create_threads()
    {
        $this->withExceptionHandling();

        $this->get('/threads/create')
             ->assertRedirect('/login');

        $this->post('/threads')
             ->assertRedirect('/login');
    }

    /**
     * auth user can create threads.
     *
     * @return void
     */
    public function test_auth_user_can_create_threads()
    {
        // Given we hve a signed user
        $this->signIn();

        // Hit endpoint, to create a new thread
        $thread = make('App\Thread');
        
        $response = $this->post('/threads/', $thread->toArray());

        // Then, we visit the thread page
        // We should see the thread
        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    // Validation test
    public function test_thread_requires_title()
    {
        $this->publishThread(['title' => null])
             ->assertSessionHasErrors('title');
    }

    // Validation test
    public function test_thread_requires_body()
    {
        $this->publishThread(['body' => null])
             ->assertSessionHasErrors('title');
    }

    // Validation test
    public function test_thread_requires_valid_channel()
    {
        factory('App\Channel', 2)->create();

        $this->publishThread(['body' => null])
             ->assertSessionHasErrors('title');

        $this->publishThread(['body' => 999])
             ->assertSessionHasErrors('title');
    }

    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread', ['title' => null]);

        return $this->post('/threads', $thread->toArray());
    }
}
