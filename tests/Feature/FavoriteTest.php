<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Favorite;
use Mockery\CountValidator\Exception;


class FavoriteTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Gust cannot favorite
     *
     * @return void
     */
    public function test_guest_can_not_favorite_anything()
    {
        $this->withExceptionHandling()
             ->post('replies/1/favorites')
             ->assertRedirect('/login');
    }

    /**
     * Auth. user can favourite reply.
     *
     * @return void
     */
    public function test_auth_user_can_favorite_any_reply()
    {
        $this->signIn();
        
        $reply = create('App\Reply');

        $this->post('replies/' . $reply->id . '/favorites');
        
        // Expect to see atleast one item in this relationship
        $this->assertCount(1, $reply->favorites);
    }

    public function test_auth_user_only_can_fav_reply_once()
    {
        $this->signIn();
        
        $reply = create('App\Reply');

        try {

            $this->post('replies/' . $reply->id . '/favorites');
            $this->post('replies/' . $reply->id . '/favorites');

        } catch (\Exception $e) {
            
            $this->fail('Did not expect to insert same record more than once into DB');
        }
        
        // Expect to see atleast one item in this relationship
        $this->assertCount(1, $reply->favorites);
    }
}
