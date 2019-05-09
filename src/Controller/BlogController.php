<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_index")
     */
    public function index()
    {

        return $this->render('blog/index.html.twig', [
            'owner' => 'Jessica',
        ]);

    }

    /**
     *
     * @Route("/blog/show/{slug}", requirements={"slug"="^[a-z0-9](-?[a-z0-9])*$"},
     * name="blog_show")
     */
    public function show(string $slug='Article sans titre')
    {
        $titleFormat = ucwords(str_replace('-',' ',(strtolower($slug))));
        return $this->render('blog/show.html.twig', [
            'slug' => $titleFormat,
            ]);
    }

}