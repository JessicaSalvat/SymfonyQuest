<?php


namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use App\Service\Slugify;
class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    private $slug;
    /**
     * ArticleFixtures constructor.
     * @param Slugify $slugify
     */
    public function __construct(Slugify $slugify)
    {
        $this->slug = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        for ($i=0; $i < 50; $i++) {
            $article = new Article();
            $article->setTitle($faker->name);
            $article->setContent($faker->text);
            $article->setCategory($this->getReference('categorie_0'));
            $slugify = new Slugify();
            $slug = $slugify->generate($article->getTitle());
            $article->setSlug($slug);
            $manager->persist($article);
            // categorie_0 fait reference à la premiere categorie générée.
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}


