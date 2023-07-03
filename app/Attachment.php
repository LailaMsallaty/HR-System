<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    public $fillable= ['filename','attachmentable_id','attachmentable_type'];
    protected $table = 'Attachments';
    public $timestamps = true;

    public function attachmentable()
    {
        return $this->morphTo();
    }
}
