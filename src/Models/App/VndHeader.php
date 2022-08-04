<?php

namespace Adw\Models\App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable;

class VndHeader extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use \Adw\Traits\TraitUuid;

    protected $table = 'vnd_header';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public function photo() {
        return 'https://eu.ui-avatars.com/api?name='.$this->vendor_name;
    }
}