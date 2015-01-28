<?php

/**
 * description class Base_Ticket_Manager is used to provide all the required functionality to run this script such as required parameters
 *
 * @author Abhijeet
 */
class Base_Ticket_Manager 
{
    
    public $requiredParameters;
    
    /**
    * description class Base_Ticket_Manager is used to provide all the required functionality to run this script such as required parameters
    *
    * @author Abhijeet
    */
    public function __construct() 
    {        
        $this->requiredParameters = array('-u', '-p');
    }
}
