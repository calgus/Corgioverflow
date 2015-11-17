<?php

namespace Anax\DI;

/**
 * Extends CDIFactoryDefault adding CForm.
 *
 */
class CDIFactory extends CDIFactoryDefault
{
    public function __construct()
    {
        parent::__construct();
 
        $this->set('form', '\Mos\HTMLForm\CForm');
    }
}
