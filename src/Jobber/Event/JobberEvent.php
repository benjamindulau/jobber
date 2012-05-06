<?php

namespace Jobber\Event;

use Symfony\Component\EventDispatcher\Event;
use Jobber\Model\JobInterface;
use Jobber\JobData\JobDataInterface;

class JobberEvent extends Event
{
    private $job;
    private $data;

    public function __construct(JobInterface $job, JobDataInterface $data)
    {
        $this->job = $job;
        $this->data = $data;
    }

    /**
     * @return JobDataInterface
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return JobInterface
     */
    public function getJob()
    {
        return $this->job;
    }
}