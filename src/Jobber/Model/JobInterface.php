<?php

namespace Jobber\Model;

interface JobInterface
{
    public function process(JobDataInterface $data);

    public function setQueue(QueueInterface $queue);

    public function getQueue();

    public function setPriority($priority);

    public function getPriority();
}