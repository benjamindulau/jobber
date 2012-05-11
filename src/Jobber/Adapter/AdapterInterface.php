<?php

namespace Jobber\Adapter;

interface AdapterInterface
{

    /**
     * Returns all available queues
     *
     * @return \Jobber\Model\QueueInterface[]
     */
    public function getQueues();

    /**
     * Returns queue with the given name
     *
     * @param string $name
     * @return \Jobber\Model\QueueInterface
     */
    public function getQueue($name);

    /**
     * Create a queue with name $name
     * and returns it
     *
     * @param string $name
     * @return \Jobber\Model\QueueInterface
     */
    public function createQueue($name);

    /**
     * Deletes queue with the given name
     * and all its jobs
     *
     * @param string $name
     * @return void
     */
    public function deleteQueue($name);
}