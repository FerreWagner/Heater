<?php

namespace app\index\model;

use think\Model;

class Feedback extends Model
{
    public function indexAdd($param)
    {
        return $this->allowField(['name','email','ip','time'])->save($param);
    }
}
