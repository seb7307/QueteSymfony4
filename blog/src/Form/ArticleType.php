<?php
/**
 * Created by PhpStorm.
 * User: seb
 * Date: 26/11/18
 * Time: 09:54
 */

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('searchField')
                ->add('category', EntityType::class, [
                    'class' => Category::class,
                    'choice_label'=> 'name',
                    ]);
    }

}