<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 5/20/14
 * Time: 10:10 PM
 */

namespace Screenfony\DemoBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Screenfony\DemoBundle\Entity\Token;
use Screenfony\DemoBundle\Entity\User;

class LoadUserData implements FixtureInterface{

    /**
     * Load data fixtures with the passed EntityManager
     *
     */
    public function load(ObjectManager $manager)
    {
        $alice = new User();
        $alice->setUsername('alice');
        $alice->setEmail('alice@dura.com');
        $alice->setPassword('dssdsd');

        $bob = new User();
        $bob->setUsername('bob');
        $bob->setEmail('bob@dsds.com');
        $bob->setPassword('dfweewe');

        $manager->persist($alice);
        $manager->persist($bob);

        $token1 = new Token();
        $token1->setApiKey('fsdg554jh34g5234u892343jrggdsrjs');
        $token1->setDateAdded(new \DateTime());

        $manager->persist($token1);

        $manager->flush();
    }
}