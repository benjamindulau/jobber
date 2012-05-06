<?php

namespace Jobber;

use Jobber\Model\JobInterface;
use Jobber\JobData\JobDataInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class JobberEvents
{
    const BEFORE_ENQUEUE = 'jobber.before_enqueue';
    const AFTER_ENQUEUE = 'jobber.after_enqueue';
}