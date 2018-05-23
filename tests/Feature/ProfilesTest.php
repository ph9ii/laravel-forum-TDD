<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ProfilesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A user has a profile.
     *
     * @return void
     */
    public function test_a_user_a_profile()
    {      
        $user = create('App\User');

        $this->get('/profiles/'.$user->name)
            ->assertSee($user->name);
    }

    /**
     * A user has profile has his threads.
     *
     * @return void
     */
    public function test_profile_display_threads_created_by_associated_user()
    {      
        $user = create('App\User');

        $thread = create('App\Thread', ['user_id' => $user->id]);

        $this->get('/profiles/'.$user->name)
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
