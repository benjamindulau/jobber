<?php

namespace Jobber\Model;

abstract class Queue extends \SplPriorityQueue implements QueueInterface
{
    /* @var string */
    protected $name;

    /* @var JobInterface[] */
    protected $jobs = array();

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function addJob(JobInterface $job)
    {
        $job->setQueue($this);
        $this->insert($job, $job->getPriority());

        return $this;
    }

    public function setJobs($jobs)
    {
        foreach($jobs as $job) {
            $this->insert($job, $job->getPriority());
        }

        $this->jobs= $jobs;
    }

    public function getJobs()
    {
        return $this->jobs;
    }

    public function pull()
    {
        return $this->extract();
    }
}