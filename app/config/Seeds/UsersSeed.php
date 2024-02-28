<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        // Users Seed
        $password = "123456";
        $data1 = [];
        $curDate = date("Y-m-d H:i:s");

        for($i=1; $i<=5; $i++) {
            $data1[] = [
                'email' => "tino{$i}@enclave.vn",
                "password" => (new DefaultPasswordHasher())->hash($password),
                "created_at" => $curDate,
                "updated_at" => $curDate,
            ];
        }

        $table = $this->table('users');
        $table->insert($data1)->save();


        // Articles Seed
        $data2 = [];
        for($i=1; $i<=5; $i++) {
            $data2[] = [
                'user_id' => $i,
                "title" => "Article 000000000{$i}",
                "body" => "Body Article 000000000{$i}",
                "created_at" => $curDate,
                "updated_at" => $curDate,
            ];
        }

        $table = $this->table('articles');
        $table->insert($data2)->save();

        // Like Article Seed
        $data3 = [];
        for($i=1; $i<=5; $i++) {
            $data3[] = [
                'user_id' => $i,
                'article_id' => $i,
                "created_at" => $curDate,
                "updated_at" => $curDate,
            ];
        }

        $table = $this->table('likes');
        $table->insert($data3)->save();
    }
}
