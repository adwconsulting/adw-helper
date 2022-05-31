<?php

namespace Adw\Auth;
use Illuminate\Database\Eloquent\Model;

class VerifyModel extends Model{

    protected $table = 'user_tokens';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public $timestamps = false;
}
