<?php

namespace Jobber\Worker;

interface WorkerInterface
{
    const STATE_PROCESSING_JOB = 0;
    const STATE_PENDING = 1;

    /**
     * Get the worker current state
     *
     * @return int
     */
    public function getState();

    /**
     * Sets queues names to pull
     * jobs from.
     *
     * @param string[] $queues
     *
     * @return void
     */
    public function setQueues(array $queues);

    /**
     * @return mixed
     */
    public function getQueues();

    /**
     * @abstract
     * @return mixed
     */
    public function work();

    /**
     * Returns current memory usage
     *
     * @return int
     */
    public function getMemoryUsage();

    /**
     * Returns current consumed time
     *
     * @return float
     */
    public function getTime();
}