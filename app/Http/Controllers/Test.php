<?php

namespace App\Http\Controllers;

class Test extends Base
{
    public function check() {
        return in_array('fishingConfig-yueka', $this->self->nav);
    }
    
    public function index()
    {        
        return view('test');
    }
}
