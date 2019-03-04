<?php
/**
 * DPModel will cache the path for dp processing
 * @Author: jiangpengfei
 * @Date:   2019-03-05
 */

namespace TextDiff;

define("PATH_TOP", 1);
define("PATH_TOPLEFT", 2);
define("PATH_LEFT", 3);
define("PATH_NONE", 0);

class DPModel {
    public $value;  // value
    public $path;   // the path of dp processing, 1:top, 2:top-left, 3:left

    
    public function __construct($v, $p)
    {
        $this->value = $v;
        $this->path = $p;
    }
}