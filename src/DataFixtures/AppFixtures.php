<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Student;
use App\Entity\Instructor;
use App\Entity\Classe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i=0; $i < 50; $i++) {
            $article = new Article();

            $article->setTitle($faker->sentence(1, true));
            $article->setDescription($faker->paragraphs(5, true));
            $article->setCreatedAt(new \DatetimeImmutable());

            $manager->persist($article);
        }

        for ($i=0; $i < 50; $i++) {
            $student = new Student();

            $student->setFirstname($faker->firstName());
            $student->setLastname($faker->lastName());
            $student->setMatricule(mt_rand(4552, 145201));
            $student->setCountry($faker->country());
            $student->setCity($faker->city());
            $student->setAddress($faker->address());
            $student->setBirthdate($faker->datetimeBetween('1980-01-01', '2006-12-31'));
            $student->setCreatedAt(new \DatetimeImmutable($faker->datetimeBetween('-3 year', 'now')->format('Y-m-d H:i:s')));

            $manager->persist($student);
        }

        for ($i=0; $i < 50; $i++) {
            $instructor = new Instructor();

            $instructor->setFirstname($faker->firstName());
            $instructor->setLastname($faker->lastName());
            $instructor->setEmail($faker->email());
            $instructor->setContact($faker->phoneNumber());
            $instructor->setCreatedAt(new \DatetimeImmutable($faker->datetimeBetween('-3 year', 'now')->format('Y-m-d H:i:s')));

            $manager->persist($instructor);
        }

        for ($i=0; $i < 50; $i++) {
            $classe = new Classe();

            $classe->setName($faker->name());
            $classe->setDescription($faker->sentence(5, true));
            $classe->setCreatedAt(new \DatetimeImmutable($faker->datetimeBetween('-3 year', 'now')->format('Y-m-d H:i:s')));

            $manager->persist($classe);
        }

        $manager->flush();
    }
}
