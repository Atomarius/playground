<?php

namespace Order;

interface EventRecording
{
    /**
     * @return array|\Iterator
     */
    public function popRecordedEvents();
}
