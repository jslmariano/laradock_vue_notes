<?php
namespace Jslmariano\Notelist\Tests;

use App\User;
use Faker\Factory;
use Tests\TestCase;

/**
 * This class describes a notelist function test.
 */
class NotelistFunctionTest extends TestCase
{

    protected $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }

    public function loginWithFakeUser()
    {
        $user = new User([
            'id'   => 1,
            'name' => 'paps',
        ]);

        $this->actingAs($user);
        $this->withSession(['foo' => 'bar']);
    }

    public function testCanCreateNote()
    {
        $this->loginWithFakeUser();

        $data = [
            'title'   => $this->faker->lexify(str_repeat('?', 50)),
            'content' => $this->faker->lexify(str_repeat('?', 500))
        ];

        $test_response = array(
            "message" => "The note successfully added",
            "note" => $data
        );

        $response = $this->post(route('notes.store'), $data);
        $response->assertStatus(200);
        $response->assertJson($test_response);
    }

    public function testCreateNoteValidations()
    {
        $this->loginWithFakeUser();


        $data = [
            'content' => $this->faker->lexify(str_repeat('?', 20))
        ];

        $response = $this->post(route('notes.store'), $data);
        $response->assertStatus(422);
        $response->assertJson(array(
            "errors" => array(
                "title" => array("Title is required!")
            )
        ));

        $data = [
            'title' => $this->faker->lexify(str_repeat('?', 20))
        ];

        $response = $this->post(route('notes.store'), $data);
        $response->assertStatus(422);
        $response->assertJson(array(
            "errors" => array(
                "content" => array("Content is required!")
            )
        ));

        $data = [
            'title'   => $this->faker->lexify(str_repeat('?', 50)),
            'content' => $this->faker->lexify(str_repeat('?', 600))
        ];

        $response = $this->post(route('notes.store'), $data);
        $response->assertStatus(422);
        $response->assertJson(array(
            "errors" => array(
                "content" => array("The content may not be greater than 500 characters.")
            )
        ));

        $data = [
            'title'   => $this->faker->lexify(str_repeat('?', 101)),
            'content' => $this->faker->lexify(str_repeat('?', 20))
        ];

        $response = $this->post(route('notes.store'), $data);
        $response->assertStatus(422);
        $response->assertJson(array(
            "errors" => array(
                "title" => array("The title may not be greater than 50 characters.")
            )
        ));
    }

    /**
     * Check that the test method returns correct result
     * @return void
     */
    public function testSimpleTestRoute()
    {
        $this->loginWithFakeUser();

        $this->get(route('notes.test'))
            ->assertStatus(200)
            ->assertJson(array(
                'message' => 'The note api successfully visible',
            ));

        $this->assertTrue(true);
    }

    /**
     * Test if endpoints returns correct value when accessed Unauthenticated
     * @return void
     */
    public function testEndpointsUnauthenticated()
    {
        $data = array(
            'message' => 'Unauthenticated.',
        );

        $this->get(route('notes.test'))
            ->assertStatus(401)
            ->assertJson($data);

        $this->get(route('notes'))
            ->assertStatus(401)
            ->assertJson($data);

        $this->post(route('notes.store'))
            ->assertStatus(401)
            ->assertJson($data);

        $this->get(route('notes.edit', 1))
            ->assertStatus(401)
            ->assertJson($data);

        $this->put(route('notes.update', 1))
            ->assertStatus(401)
            ->assertJson($data);

        $this->delete(route('notes.delete', 1))
            ->assertStatus(401)
            ->assertJson($data);

    }

}
