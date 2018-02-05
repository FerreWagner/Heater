<?php

namespace app\admin\model;

use think\Model;

class System extends Model
{
    public function getSys()
    {
        return $this->get(1);
    }
}
