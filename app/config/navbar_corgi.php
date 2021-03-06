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
            'text'  => 'Hundkojan',
            'url'   => $this->di->get('url')->create(''),
            'title' => 'Överblick av CorgiOverflow'
        ], 

        // This is a menu item
        'Comments' => [
            'text'  =>'Frågor',
            'url'   => $this->di->get('url')->create('questions'),
            'title' => 'Se alla Corgi frågor som ställts',
        ],    
        
        // This is a menu item
        'Categories' => [
            'text'  =>'Taggar',
            'url'   => $this->di->get('url')->create('categories'),
            'title' => 'Se alla Corgi relaterade taggar',
        ],                       
        
        // This is a menu item
        'Users' => [
            'text'  =>'Användare',
            'url'   => $this->di->get('url')->create('users'),
            'title' => 'Se alla Corgi människor',
        ],  
        
        // This is a menu item
        'About' => [
            'text'  =>'Om oss',
            'url'   => $this->di->get('url')->create('about'),
            'title' => 'Läs om oss',
        ],
        
        // This is a menu item
        'login'  => [
            'text'  => $this->di->session->get('user') ? 'Min Profil' : 'Logga in',
            'url'   => $this->di->get('url')->create('login'),
            'title' => 'Profilhantering',
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
