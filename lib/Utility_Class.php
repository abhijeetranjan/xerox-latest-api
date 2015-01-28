<?php

    require_once 'Core.php';
    require_once 'Repo_Factory.php';
    
    /**
     * Description class Utility_Class provides the basic functionality to this script.
     *
     * @author Abhijeet
     */
    class Utility_Class extends Core 
    {     
        
        protected $errorFlag = true;
        public $dataHeader = array();        
        public $repoURL;
        public $username;
        public $password;
        
        /**
        * Description class UtilityManager provides the basic functionality to this script.
        *
        * @author Abhijeet
        */
        public function __construct() 
        {
            parent::__construct();
        }
        
        /**
         * Description Method is used to bind parameters from an array argument
         * @param array $args
         */
        public function processArgs(array $args) 
        {       
            if(count($args) < 8) {                
                if(count($args) == 2 && $args[1] == '--help') {
                    $this->customErrorHandler->showHelp($args);
                } else {
                    $this->customErrorHandler->throwError('Missing required parameters',$args);
                }                
                
            }
            
            $arrRequiredParam = $this->baseTicketManager->requiredParameters;
            
            if($this->is_in_array($arrRequiredParam, $args)) {                
                $this->bindParameters($args);
            } else {            
                $this->customErrorHandler->throwError('Missing required parameters', $args);
            }
        }        
        
        /**
         * 
         * description function validates if passed arguement contains the required field or not
         * @param type $needle
         * @param type $haystack
         * @return boolean
         */
        public function is_in_array($needle, $haystack) 
        {                        
            foreach ($needle as $stack) {                    
                if (!in_array($stack, $haystack)) {                    
                     return $this->errorFlag = false;
                }
            }
            return $this->errorFlag;
        }
        
        /**
         * 
         * description function validates the passed arguements and binds the values with the required parameters
         * @param array $args
         * @return boolean
         */
        public function bindParameters(array $args) 
        {            
            $explodedArray = array();
            
            /**
             * description: checks if arguement passed have required parameters
             */            
            if($args[1] != '-u' || $args[3] != '-p') {
                $this->customErrorHandler->throwError('Invalid parameters', $args);
            }
                        
            $this->username = $args[2];
            $this->password = $args[4];
            $this->repoURL = $args[5];
            
            $repoFactory = Repo_Factory::createRepoUrl($this->repoURL);
            
            $arrayCount = count($args);
            
            // binds the parameters passed through script into an associative array
            for($i = 6; $i < $arrayCount; $i++) {
                if($i != '-d') {
                    if(strpos($args[$i], '=')) {
                        $explodedArray = explode('=', $args[$i]);
                        $this->dataHeader[$explodedArray[0]] = $explodedArray[1];
                    } else {
                        array_push($this->dataHeader, $args[$i]);  // function is used to push the values into array                  
                    }
                }
            }                                  
            $repoFactory->response($this->username, $this->password, $this->dataHeader);
        }        
                
    }
