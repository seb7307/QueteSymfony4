<?php
/**
 * Created by PhpStorm.
 * User: seb
 * Date: 13/11/18
 * Time: 15:58
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{

    /**
     * @Route("/blog", name="blog_index")
     * @return Response A response instance
     */
    public function index () : Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }
        return $this->render(
            'blog/index.html.twig',
            ['articles' => $articles]
        );
    }

    /**
     * @param string $slug The slugger
     *
     * @Route("t/{slug<^[a-z0-9-]+$>}",
     *     defaults={"slug"=null},
     *     name="blog_show"),
     * @return Response A response instance
     */
    public function show($slug) : Response
    {
        if (!$slug){
            throw $this->createNotFoundException('No slug has been sent to find an article in article\'s table');
        }
        $slug = preg_replace (
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        if (!$article){
            throw $this->createNotFoundException(
                'No article with' .$slug. 'title, found in article \'s table'
            );
        }

        return $this->render('blog/show.html.twig',
            ['article' => $article,
                'slug' => $slug,
            ]);
    }

    /**
     * @param string $category
     * @Route("/category/{category}", name="blog_show_category").
     * @return Response
     */

        public function showByCategory( string $category) : Response
        {
            $categoryRepository = $this->getDoctrine()
                ->getRepository(Category::class);
            $onecategory = $categoryRepository->findOneByName($category);

            $articleRepository = $this->getDoctrine()
                ->getRepository(Article::class);
            $articles = $articleRepository ->findBy(['category'=>$onecategory],
                                                     ['id' => 'DESC'],
                                                        3);

            return $this->render('blog/category.html.twig',
            ['articles' => $articles,
                'category'=> $onecategory,
            ]);
        }


}
