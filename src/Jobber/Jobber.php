<?php

namespace Jobber;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Jobber\Model\JobInterface;
use Jobber\JobData\JobDataInterface;
use Jobber\Event\JobberEvent;
use Jobber\JobberEvents;

class Jobber
{
    protected $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function enqueue(JobInterface $job, JobDataInterface $data)
    {
        $event = new JobberEvent($job, $data);
        $this->dispatcher->dispatch(JobberEvents::BEFORE_ENQUEUE, $event);

        // Do something

        $event = new JobberEvent($job, $data);
        $this->dispatcher->dispatch(JobberEvents::AFTER_ENQUEUE, $event);
    }


}