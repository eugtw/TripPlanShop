<?php
/*
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
*/
use App\User;




class AuthTest extends TestCase
{
    use \Laracasts\Integrated\Services\Laravel\DatabaseTransactions;

    public function test_redirect_to_homepage_if_user_is_signedin()
    {
        $user = new User(array('name' => 'John'));
        $this->be($user); //You are now authenticated

        $this->call('GET', '/');
        $this->assertRedirectedTo('/home');
    }

    public function test_redirect_to_promo_page_if_user_not_signedin()
    {
        $this->call('GET', '/');
        $this->assertRedirectedTo('/promo');
    }


    public function test_redirect_to_promo_after_logout(){
        $this->call('GET', '/auth/logout');
        $this->assertRedirectedTo('/');
    }

    /** @test*/
    public function redirect_when_account_activation_succeeds()
    {
        $faker = \Faker\Factory::create();
        $token = str_random(10);
        $user = User::create([
            'name' => $faker->firstName,
            'email' => $faker->email,
            'activation_token' => $token
        ]);

        $return_user = User::activation($token)->get()->first();
        $this->assertEquals($user->id, $return_user->id);

        $this->visit('/login');
        $this->assertResponseOk();
        //$response = $this->call('GET', 'account/activate/{token}', ['token' => $user->activation_token]);
        //$this->assertEquals(200, $response->getStatusCode());
        //$this->assertSessionHas('message');
        //$this->assertRedirectedTo('/login');
    }
    /** @test*/
    public function redirect_when_account_activation_fails()
    {
        $faker = \Faker\Factory::create();
        $token = str_random(10);
        $user = User::create([
            'name' => $faker->firstName,
            'email' => $faker->email,
            'activation_token' => $token
        ]);

        $return_user = User::activation('123321')->get()->first();
        $this->assertEquals(null, $return_user);
    }

    /** @test
    public function flash_msg_when_account_activation_failed()
    {
        $user = new User(array('token' => 'abcd'));
        $response = $this->action('GET', 'UsersController@activate', ['token' => '1234']);
        $this->assertEquals('Failed to activate account!! Please use the latest sent activation link.',
            $response->getContent());
    }*/

    /** @test */
    public function is_able_to_log_in()
    {
        $faker = \Faker\Factory::create();
        $password = $faker->password;
        $user = User::create([
            'name' => $faker->firstName,
            'email' => $faker->email,
            'password' => bcrypt($password),
            'active' => 1
        ]);

        $this->visit('/login')
            ->type($user->email, 'email')
            ->type($password, 'password')
            ->press('Sign in')
            ->assertTrue(Auth::check());

        $this->seePageIs('/home');
    }


    //test_redirect_to_home_after_signin_with_facebook

}