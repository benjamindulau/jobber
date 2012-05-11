<?php

namespace Jobber\Model;

interface JobInterface
{
    const STATE_PENDING = 0;
    const STATE_PROCESSING = 1;
    const STATE_ABORTED = 3;
    const STATE_COMPLETE = 4;
    const STATE_ERROR = -1;

    /**
     * Returns the unique identifier for this job
     *
     * @return string
     */
    public function getJobId();

    /**
     * Set the job data. Must receive a serializable
     * object
     *
     * @param JobDataInterface $data
     *
     * @return void
     */
    public function setData(JobDataInterface $data);

    /**
     * Returns job data
     *
     * @return JobDataInterface
     */
    public function getData();

    /**
     * Returns job's current state
     *
     * @return int
     */
    public function getState();

    /**
     * Sets job's state
     *
     * @param int $state
     *
     * @return void
     */
    public function setState($state);

    /**
     * Returns job start date
     *
     * @return \DateTime
     */
    public function getStartedAt();

    /**
     * Starts the job
     *
     * @return void
     */
    public function start();

    /**
     * Returns job abortion date
     *
     * @return \DateTime
     */
    public function getAbortedAt();

    /**
     * Aborts job
     *
     * @return void
     */
    public function abort();

    /**
     * Returns date the job completed at
     *
     * @return \DateTime
     */
    public function getCompletedAt();

    /**
     * Completes the job
     *
     * @return void
     */
    public function complete();

    /**
     * Fails the job
     *
     * @return void
     */
    public function fail();

    /**
     * Returns job creation date
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Returns job last update date
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * Returns job's priority in the current queue
     *
     * @return int
     */
    public function getPriority();

    /**
     * Sets the queue the job is added in
     *
     * @param QueueInterface $queue
     *
     * @return void
     */
    public function setQueue(QueueInterface $queue);

    /**
     * Returns the queue the job is in
     *
     * @return QueueInterface
     */
    public function getQueue();

    /**
     * Actually performs the job behaviour
     *
     * @return boolean
     */
    public function process();

    /**
     * Returns execution time
     *
     * @return float
     */
    public function getTime();

    /**
     * Returns consumed memory
     *
     * @return int
     */
    public function getMemory();
}