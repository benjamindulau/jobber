<?php

namespace Jobber\Model;

abstract class Job implements JobInterface
{
    protected $data;
    protected $state;
    protected $queue;
    protected $priority;
    protected $createdAt;
    protected $updatedAt;
    protected $startedAt;
    protected $completedAt;
    protected $abortedAt;
    protected $canceledAt;
    protected $time;
    protected $memory;

    public function __construct()
    {
        $this->priority = 0;
        $this->createdAt = $this->updatedAt = new \DateTime();
        $this->state = self::STATE_PENDING;
        $this->time = 0;
        $this->memory = 0;
    }

    public function setAbortedAt(\DateTime $abortedAt)
    {
        $this->abortedAt = $abortedAt;
    }

    public function getAbortedAt()
    {
        return $this->abortedAt;
    }

    public function abort()
    {
        $this->setAbortedAt(new \DateTime());
        $this->setState(self::STATE_ABORTED);
        $this->cleanUp();
    }

    public function setCanceledAt(\DateTime $canceledAt)
    {
        $this->canceledAt = $canceledAt;
    }

    public function getCanceledAt()
    {
        return $this->canceledAt;
    }

    public function setCompletedAt(\DateTime $completedAt)
    {
        $this->completedAt = $completedAt;
    }

    public function getCompletedAt()
    {
        return $this->completedAt;
    }

    public function complete()
    {
        $this->setCompletedAt(new \DateTime());
        $this->setState(self::STATE_COMPLETE);
        $this->cleanUp();
    }

    public function fail()
    {
        $this->setState(self::STATE_ERROR);
        $this->cleanUp();
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setData(JobDataInterface $data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setStartedAt(\DateTime $startedAt)
    {
        $this->startedAt = $startedAt;
    }

    public function getStartedAt()
    {
        return $this->startedAt;
    }

    public function start()
    {
        $this->memory = memory_get_usage(true);
        $this->time = microtime(true);

        $this->setStartedAt(new \DateTime());
        $this->setState(self::STATE_PROCESSING);
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function setQueue(QueueInterface $queue)
    {
        $this->queue = $queue;
    }

    public function getQueue()
    {
        return $this->queue;
    }

    public function cleanUp()
    {
        $this->memory = memory_get_usage(true) - $this->memory;
        $this->time = microtime(true) - $this->time;
    }
}