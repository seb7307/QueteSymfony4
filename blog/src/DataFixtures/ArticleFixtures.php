<?php
/**
 * Created by PhpStorm.
 * User: seb
 * Date: 28/11/18
 * Time: 16:04
 */

namespace App\DataFixtures;


use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // confirmation de la langue utilise par faker
        $faker = Faker\Factory::create('fr_FR');

        //creation de 50 articles
        for ($i = 0; $i < 50; $i++) {
            $article = new Article();
            $article->setTitle(mb_strtolower($faker->sentence()));
            $article->setContent($faker->text);
            $article->setCategory($this->getReference('categorie_' .rand(0,4)));
            $manager->persist($article);
        }
        $manager->flush();
        // TODO: Implement load() method.
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
        // TODO: Implement getDependencies() method.
    }
}