<?php

namespace Jobber\Event;

use Symfony\Component\EventDispatcher\Event;
use Jobber\Model\JobInterface;

class JobberEvent extends Event
{
    private $job;

    public function __construct(JobInterface $job)
    {
        $this->job = $job;
    }

    /**
     * @return JobInterface
     */
    public function getJob()
    {
        return $this->job;
    }
}