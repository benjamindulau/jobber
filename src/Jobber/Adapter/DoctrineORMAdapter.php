<?php

namespace Jobber\Adapter;

use Doctrine\Common\Persistence\ObjectManager;

class DoctrineORMAdapter implements AdapterInterface
{
    protected $class = '\Jobber\Entity\Queue';
    protected $manager;

    public function __construct($class, ObjectManager $objectManager)
    {
        $this->class = $class;
        $this->manager = $objectManager;
    }

    public function getQueues()
    {
        // TODO: Implement getQueues() method.
    }

    public function getQueue($name)
    {
        // TODO: Implement getQueue() method.
    }

    public function createQueue($name)
    {
        $queue = new $this->class($name);

        $this->manager->persist($queue);
        $this->manager->flush();

        return $queue;
    }

    public function deleteQueue($name)
    {
        // TODO: Implement deleteQueue() method.
    }
}