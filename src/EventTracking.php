<?php

namespace DevOption\EventTracking;

use DevOption\EventTracking\Event;

trait EventTracking
{
    public $oldAttributes = [];
    public $newAttributes = [];

    public static function bootEventTracking()
    {
        $events = ['created', 'updated', 'deleted'];

        foreach ($events as $event) {
            static::$event(function ($model) use ($event) {
                $model->oldAttributes = $model->getOriginal();
                if ($event === 'created') {
                    $model->newAttributes = $model->getAttributes();
                } else {
                    $model->newAttributes = $model->getChanges();
                }
                $model->track_event($event);
            });
        }
    }

    protected function track_event($event)
    {
        Event::create([
            'user_id'       => auth()->check() ? auth()->user()->id : null,
            'description'   => $event . '_' . strtolower(class_basename($this)),
            'event_id'      => $this->id,
            'event_type'    => get_class($this),
            'data'          => [
                'before'    => $this->oldAttributes,
                'after'     => $this->newAttributes,
            ],
        ]);
    }



}
