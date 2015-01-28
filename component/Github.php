<?php

require_once getcwd().DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'Base_Repo.php';
require_once 'Component_Interface.php';

/**
 * Description class GITHUB is used to create response and request of new issues on github
 *
 * @author Abhijeet
 */

class Github extends Base_Repo implements Component_Interface 
{
    
    protected $repositoryURL = GITHUB_REPO_URL; // default url to access api
    protected $param = array('title', 'body');
    protected $gitHubApiUrl = 'https://api.github.com/repos';
    
    /**
     * description magic method __construct is created to assign repository url when the object of class created
     * @param string $repoUrl
     */
    public function __construct($repoUrl='') 
    {
        if(!empty($repoUrl)) {
            $trimmedRepoUrl = rtrim($repoUrl,'/');
            $parsedRepoUrl= parse_url($repoUrl);
            
            if(!isset($parsedRepoUrl['path']) && empty($parsedRepoUrl['path'])) {
                $Display_Manager = new Display_Manager();
                $Display_Manager->showErrorMessage('Invalid Repository Url, Please refer to readme.md');
            }            
            
            $parsedUrlPath = rtrim($parsedRepoUrl['path'], '/');            
            $this->repositoryURL = $this->gitHubApiUrl . $parsedUrlPath . '/issues';         
        }
    }
    
    /**
     * 
     * description function response is used to create request and response for new issues
     * @param type $method
     * @param string $username
     * @param string $password
     * @param array $arrData
     */
    public function response($username, $password, $arrData) 
    {        
        $Base_Repo = new Base_Repo();
        $arrData = $this->bindArgsWithParam($arrData, $this->param);
        
        $postData = json_encode($arrData);
        
        if(empty($this->repositoryURL)) {
            $message = 'Repository Url is invalid';
            $Base_Repo->Display_Manager->showErrorMessage($message);
        }
        
        $Base_Repo->sendRequest($username, $password, $this->repositoryURL, $postData);
    }
        
    /**
     * description function is used to bind arguement with param
     * @param array $arrData
     * @return array $arrBinded
     */
    public function bindArgsWithParam(array $arrData, array $param) 
    {
        $k = 0; $arrBinded = array();
        foreach($arrData as $key=>$value) {
            if(!is_string($key)) {
                if(isset($param[$k])) {                    
                    $arrBinded[$param[$k]] = $value;                    
                } else {
                    $arrBinded[$key] = $value;
                }
            } else {
                $arrBinded[$key] = $value;
            }
            $k++;
        }
        
        return $arrBinded;
    }
}
