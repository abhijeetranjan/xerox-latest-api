<?php

/**
 * Description class Repo_Factory is used to create object of the class on runtime depending on the requested repository
 *
 * @author Abhijeet
 */

class Repo_Factory 
{
    
    /**
     * description function is declared as static so no other instance can be generated and returns the object of desired api on runtime
     * @param string $repoIdentifier
     * @return object \GENERIC|\repoIdentifier|\BITBUCKET|\GITHUB
     */
    public static function createRepoUrl($repoIdentifier) 
    {        
        if(!filter_var($repoIdentifier, FILTER_VALIDATE_URL)) {            
            $repoIdentifier = strtoupper($repoIdentifier);
            self::__autoload($repoIdentifier);
            return new $repoIdentifier();
        } else {            
            if(strpos($repoIdentifier, 'github')) {                
                self::__autoload('Github');
                return new Github($repoIdentifier);
            } else if(strpos($repoIdentifier, 'bitbucket')) {                
                self::__autoload('Bitbucket');
                return new Bitbucket($repoIdentifier);
            } else {                
                self::__autoload('Generic');
                return new Generic($repoIdentifier);
            }
        }
    }
    
    /**
     * description magic method __autoload is used to include desired class on runtime
     * @param string $className
     */
    public static function __autoload($className) 
    {        
        $fileName = getcwd().DIRECTORY_SEPARATOR.'component'.DIRECTORY_SEPARATOR. $className .'.php';
        
        if(!file_exists($fileName)) {
            $displayManager = new Display_Manager();
            $message = 'Invalid Repository Url';
            $displayManager->showErrorMessage($message);
        } else {
            include $fileName;
        }
        
    }
}
