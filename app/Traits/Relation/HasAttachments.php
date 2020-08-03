<?php

namespace App\Traits\Relation;

trait HasAttachments
{
    public function attachments()
    {
        return $this->hasMany('App\Attachment');
    }
}
