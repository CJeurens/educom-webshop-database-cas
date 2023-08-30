<?php 
class PageController
{
    private $request;
    private $response;
    
    public function handleRequest()
    {
        $this->getRequest();
        $this->validateRequest();
        $this->showResponse();
    }
    
    private function getRequest()
    {
        $posted = ($_SERVER['REQUEST_METHOD']==='POST');
        $this->request = 
            [
                'posted' => $posted,
                'page'     => $this->getRequestVar('page', $posted, 'home')    
            ];
    }
    
    private function validateRequest()
    {
        $this->response = $this->request; // getoond == gevraagd
        if ($this->request['posted'])
        {
            switch ($this->request['page'])
            {
                case "contact":
                    $fields = array("name", "email", "msg");

                    require_once "sanitize_data.php";
                    $sanitize = new SanitizeData;

                    require_once "retrievepost.php";
                    $post = new RetrievePost($fields, $sanitize);
                    $san_data = $post->retrieve();

                    require_once "validator.php";
                    $validate = new Validator($san_data);
                    $val_data=$validate->validate();
                    break;
            }

        }
        else
        {
            switch ($this->request['page'])
            {
            // get request afhandelingen die meerdere antwoorden kunnen genereren....
            // zie uitleg Request-Response overview
            }
        }
    }
    
    private function showResponse()
    {
        require_once "PageModel.php";
        $model = new PageModel;
        $content = $model->getPageContent($this->request);

        if ($content)
        {
            require_once "PageView.php";
            $view = new PageView;
            $view->displayPage($content);
        }
    }
    
    private function getRequestVar(string $key, bool $frompost, $default="", bool $asnumber=FALSE)
    {
        $filter = $asnumber ? FILTER_SANITIZE_NUMBER_FLOAT : FILTER_SANITIZE_STRING;
        $result = filter_input(($frompost ? INPUT_POST : INPUT_GET), $key, $filter);
        return ($result===FALSE) ? $default : $result;
    }  
}    
?>