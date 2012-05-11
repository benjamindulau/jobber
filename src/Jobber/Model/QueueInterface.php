<?php

namespace Jobber\Model;

interface QueueInterface
{
    /**
     * @param JobInterface $job
     *
     * @return mixed
     */
    public function addJob(JobInterface $job);

    /**
     * @return JobInterface[]
     */
    public function getJobs();

    /**
     * @return string
     */
    public function getName();

    /**
     * Shift an element from the top of the
     * Queue.
     *
     * @return JobInterface
     */
    public function pull();
}