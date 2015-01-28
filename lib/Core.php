<?php

require_once 'Base_Ticket_Manager.php';
require_once 'Custom_Error_Handler.php';

/**
 * Description of Core
 *
 * @author Abhijeet
 */
class Core 
{
    
    protected $customErrorHandler;
    protected $baseTicketManager;
    
    /**
     * description In __construct, we initialise the Custom_Error_Handler and Base_Ticket_Manager class that can be accessible to ulitiyclass 
     *              to throw any error and to validate passed parameters
     * 
     */
    public function __construct() 
    {        
        $this->baseTicketManager = new Base_Ticket_Manager();
        $this->customErrorHandler = new Custom_Error_Handler();
    }
}
