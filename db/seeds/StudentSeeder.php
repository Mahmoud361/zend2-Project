<?php


use Phinx\Seed\AbstractSeed;

class StudentSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker =  Faker\Factory::create();
        for ($i =0 ; $i < 5 ; $i++) {
            $data = array(
                array(
                    'fristName' => $faker->firstName,
                    'lastName' => $faker->lastName,
                    'email' => $faker->email,
                    'address' => $faker->address,
                )
            );

            $students = $this->table('student');
            $students->insert($data);
            $students->save();
        }

    }
}
