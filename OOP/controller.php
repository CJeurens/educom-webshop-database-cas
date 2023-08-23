<?php 
class Controller
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
            // post request afhandelingen die meerdere antwoorden kunnen genereren....
            // zie uitleg Request-Response overview
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

        /*require_once "getpage.php";
        $getPage = new GetPage;*/

        $navlinks = array(
            "home"      => "🏠HOME",         //"link address" => "link display name"
            "about"     => "ℹ️ABOUT",
            "contact"   => "📞CONTACT",
            "shop"      => "🛍️SHOP"
        );

        $author = "Cas Jeurens";
        $page = "";

        switch ($this->response['page'])
        {
            case "home":
                require_once "content_text.php";
                $page = new TextContent(
                    title: "🏠HOME",
                    header: "🏠DIT IS HOME",
                    navlinks: $navlinks,
                    author: $author,
                    text: array(
                        "Van harte welkom op deze zeer mooie webpagina!"
                    ));
                break;
            case "about":
                require_once "content_text.php";
                $page = new TextContent(
                    title: "ℹ️ABOUT",
                    header: "ℹ️DIT IS ABOUT",
                    navlinks: $navlinks,
                    author: $author,
                    text: array(
                        "Deze webpagina is speciaal ontwikkeld om mij te helpen de html-taal te leren.",
                        "Ik heb biologie gestudeerd aan Wageningen University & Research waar ik coole dingen heb geleerd over plantjes, diertjes en ander gespuis.",
                        "Tevens ben ik opgegroeid in Roermond waar ik talloze vlaaien heb gegeten. Mijn favoriet is appel-citroen."
                    ));
                break;
            case "contact":
                require_once "form_contact.php";
                $page = new ContactForm(
                    title: "📞CONTACT",
                    header: "📞DIT IS CONTACT",
                    navlinks: $navlinks,
                    author: $author,
                    form: "contact",
                    method: "",
                    fields: "");
                break;
            case "login":
                require_once "form_login.php";
                $page = new LoginForm(
                    title: "👤ACCOUNT",
                    header: "👤ACCOUNT",
                    navlinks: $navlinks,
                    author: $author,
                    form: "login",
                    method: "",
                    fields: "");
                break;
            case "register":
                require_once "form_register.php";
                $page = new RegisterForm(
                    title: "👤ACCOUNT",
                    header: "👤ACCOUNT",
                    navlinks: $navlinks,
                    author: $author,
                    form: "register",
                    method: "",
                    fields: "");
                break;
        }
        if (empty($page))
        {
            print "Please return to where you came from";
        }
        else
        {
            $page->show();
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