<?php

namespace Jobber;

use Jobber\Adapter\AdapterInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Jobber\Model\JobInterface;
use Jobber\JobData\JobDataInterface;
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

    public function enqueue($queue, JobInterface $job, JobDataInterface $data)
    {
        $event = new JobberEvent($job, $data);
        $this->dispatcher->dispatch(JobberEvents::BEFORE_ENQUEUE, $event);

        // Do something
        $this->adapter->getQueue($queue)->addJob($job);
x
        $event = new JobberEvent($job, $data);
        $this->dispatcher->dispatch(JobberEvents::AFTER_ENQUEUE, $event);
    }

}