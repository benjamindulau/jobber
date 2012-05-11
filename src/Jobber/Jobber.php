<?php

namespace Jobber;

use Jobber\Adapter\AdapterInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Jobber\Model\JobInterface;
use Jobber\Event\JobberEvent;
use Jobber\JobberEvents;

class Jobber
{
    protected $dispatcher;
    protected $adapter;

    public function __construct(AdapterInterface $adapter, EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        $this->adapter = $adapter;
    }

    public function enqueue($queueName, JobInterface $job)
    {
        $event = new JobberEvent($job);
        $this->dispatcher->dispatch(JobberEvents::BEFORE_ENQUEUE, $event);

        if (null === ($queue = $this->adapter->getQueue($queueName))) {
            $queue = $this->adapter->createQueue($queueName);
        }
        $queue->addJob($job);

        $this->dispatcher->dispatch(JobberEvents::AFTER_ENQUEUE, $event);
    }

    public function dequeue($queueName, JobInterface $job)
    {
        $event = new JobberEvent($job);
        $this->dispatcher->dispatch(JobberEvents::BEFORE_ENQUEUE, $event);

        // TODO

        $this->dispatcher->dispatch(JobberEvents::AFTER_ENQUEUE, $event);
    }
}