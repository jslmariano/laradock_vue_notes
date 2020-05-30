<?php
namespace Tests;

use App\User;
use Tests\TestCase;

class NotelistFunctionTest extends TestCase
{

    public function loginWithFakeUser()
    {
        $user = new User([
            'id'   => 1,
            'name' => 'paps',
        ]);

        $this->actingAs($user, 'api');
    }

    /**
     * Check that the test method returns correct result
     * @return void
     */
    public function testTestReturnsCorrectValue()
    {
        $this->loginWithFakeUser();
        $response = $this->json('GET', 'api/notes/test');
        $response->assertStatus(200);
    }

    /**
     * Check that the test method cannot be accessed without auth
     * @return void
     */
    public function testActionsRedirectWithoutAuth()
    {
        $response = $this->json('GET', 'api/notes');
        $response->assertStatus(401);
        $response->assertLocation('/');
        $response = $this->json('GET', 'api/notes/test');
        $response->assertStatus(200);
        $response->assertLocation('/');
        $response = $this->json('GET', 'api/notes/add');
        $response->assertStatus(200);
        $response->assertLocation('/');
    }

}
