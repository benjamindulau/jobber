<?php

namespace Jobber\Model;

interface JobDataInterface
{
    /**
     * Returns a normalized representation of
     * the job data
     *
     * @return array
     */
    public function normalize();
}