<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar',
 
    // Here comes the menu strcture
    'items' => [

        // This is a menu item
        'home'  => [
            'text'  => 'Hem',
            'url'   => $this->di->get('url')->create(''),
            'title' => 'Home route of current frontcontroller'
        ],
        
        // This is a menu item
        'Redovisning'  => [
            'text'  => 'Redovisning',
            'url'   => $this->di->get('url')->create('redovisning'),
            'title' => 'Submenu with url as internal route within this frontcontroller',

        ],

        // This is a menu item
        'Theme'  => [
            'text'  => 'Theme',
            'url'   => $this->di->get('url')->create('theme.php'),
            'title' => 'Submenu with url as internal route within this frontcontroller',

            // Here we add the submenu, with some menu items, as part of a existing menu item
            'submenu' => [

                'items' => [

                    // This is a menu item of the submenu
                    'Regioner'  => [
                        'text'  => 'Regioner',
                        'url'   => $this->di->get('url')->create('theme.php/regioner'),
                        'title' => 'Submenu with url as internal route within this frontcontroller',
            
                    ],     

                    // This is a menu item of the submenu
                    'Typografi'  => [
                        'text'  => 'Typografi',
                        'url'   => $this->di->get('url')->create('theme.php/typografi'),
                        'title' => 'Submenu with url as internal route within this frontcontroller',
                    ],    

                    // This is a menu item of the submenu
                    'Fontawesome'  => [
                        'text'  => 'Font Awesome',
                        'url'   => $this->di->get('url')->create('theme.php/fontawesome'),
                        'title' => 'Submenu with url as internal route within this frontcontroller',
                    ],    
                ],
            ],
        ],        
        
        // This is a menu item
        'Dice' => [
            'text'  =>'Tärning',
            'url'   => $this->di->get('url')->create('dice'),
            'title' => 'Url to relative frontcontroller, other file',
        ],     
        
        // This is a menu item
        'Comments' => [
            'text'  =>'Kommentarer',
            'url'   => $this->di->get('url')->create('comments'),
            'title' => 'Url to relative frontcontroller, other file',
        ],                       
        
        // This is a menu item
        'Showall' => [
            'text'  =>'Användare',
            'url'   => $this->di->get('url')->create('showall'),
            'title' => 'Url to relative frontcontroller, other file',
        ],  
        
        // This is a menu item
        'Källkod' => [
            'text'  =>'Källkod',
            'url'   => $this->di->get('url')->create('source'),
            'title' => 'Url to relative frontcontroller, other file',
        ],

    ],
 


    /**
     * Callback tracing the current selected menu item base on scriptname
     *
     */
    'callback' => function ($url) {
        if ($url == $this->di->get('request')->getCurrentUrl(false)) {
            return true;
        }
    },



    /**
     * Callback to check if current page is a decendant of the menuitem, this check applies for those
     * menuitems that has the setting 'mark-if-parent' set to true.
     *
     */
    'is_parent' => function ($parent) {
        $route = $this->di->get('request')->getRoute();
        return !substr_compare($parent, $route, 0, strlen($parent));
    },



   /**
     * Callback to create the url, if needed, else comment out.
     *
     */
   /*
    'create_url' => function ($url) {
        return $this->di->get('url')->create($url);
    },
    */
];
