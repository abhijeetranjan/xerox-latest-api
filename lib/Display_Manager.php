<?php

/**
 * description class Display_Manager is used to provide the interface for displaying messages
 *
 * @author Abhijeet
 */
class Display_Manager 
{
    
    /**
     * description showErrorMessage function is used to display error message
     * @param string $message
     */
    public function showErrorMessage($message) 
    {        
        echo '[ERROR]: '. $message .PHP_EOL; die;
    }
    
    /**
     * description showErrorMessage function is used to display success message
     * @param string $message
     */
    public function showSuccessMessage($message) 
    {        
        echo '[SUCCESS]: '. $message .PHP_EOL; die;
    }
    
    /**
     * description showErrorMessage function is used to display any message other than error and success
     * @param string $message
     */
    public function showMessage($message) 
    {        
        echo $message . PHP_EOL; die;
    }
}
