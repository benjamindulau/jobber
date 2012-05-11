<?php

namespace Jobber\Worker;

class Worker implements WorkerInterface
{
    protected $state;
    protected $memoryUsage;
    protected $time;
    protected $queues;

    /**
     * @param \Jobber\Model\QueueInterface[] $queues
     */
    public function __construct(array $queues)
    {
        $this->state = self::STATE_PENDING;
        $this->memoryUsage = 0;
        $this->time = 0;
        $this->queues = $queues;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }

    public function work()
    {
        $this->memoryUsage = memory_get_usage(true);
        $this->time = microtime(true);

        while(null !== ($job = $this->pullJob())) {
            try {
                $job->start();
                $job->process();
                $job->complete();
            } catch(\Exception $e) {
                // TODO
                $job->fail();
            }

            // $job->getTime();
            // $job->getMemory();
        }
    }

    public function pullJob()
    {
        foreach($this->queues as $queue) {
            if (!empty($queue)) {
                return $queue->pull();
            }
        }

        return null;
    }
}