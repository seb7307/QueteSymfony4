<?php
/**
 * Created by PhpStorm.
 * User: seb
 * Date: 28/11/18
 * Time: 14:16
 */

namespace App\DataFixtures;


use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    private const CATEGORIES = [
        'PHP',
        'Java',
        'Javascript',
        'Ruby',
        'DevOps'
    ];

    public function  load(ObjectManager $manager)
    {

        foreach (self::CATEGORIES as $key => $categoryName)
        {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference('categorie_' .$key, $category);
        }
        $manager->flush();
        // TODO: Implement load() method.
    }
}