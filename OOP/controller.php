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
                require_once "form.php";
                $page = new Form(
                    title: "📞CONTACT",
                    header: "📞DIT IS CONTACT",
                    navlinks: $navlinks,
                    author: $author,
                    form: "contact",
                    method: "POST",
                    fields: array
                    (
                        "name"  =>  array(
                                        "name"      =>  "name",
                                        "label"     =>  "Name:",
                                        "type"      =>  "text",
                                        "default"   =>  "''"
                        ),
                        "email" =>  array(
                                        "name"      =>  "email",
                                        "label"     =>  "E-mail:",
                                        "type"      =>  "text",
                                        "default"   =>  "''"
                        ),
                        "msg" =>  array(
                                        "name"      =>  "msg",
                                        "label"     =>  "Message:",
                                        "type"      =>  "textarea",
                                        "default"   =>  "''"
                        ),
                        "submit" =>  array(
                                        "name"      =>  "submit",
                                        "label"     =>  "",
                                        "type"      =>  "submit",
                                        "default"   =>  "Send"
                        ),
                        "hidden" =>  array(
                                        "name"      =>  "page",
                                        "label"     =>  "",
                                        "type"      =>  "hidden",
                                        "default"   =>  "contact"
                        )
                    ));
                break;
            case "login":
                require_once "form.php";
                $page = new Form(
                    title: "👤ACCOUNT",
                    header: "👤ACCOUNT",
                    navlinks: $navlinks,
                    author: $author,
                    form: "login",
                    method: "POST",
                    fields: array
                    (
                        "email" =>  array(
                                        "name"  =>  "email",
                                        "label" =>  "E-mail:",
                                        "type"  =>  "text",
                                        "value" =>  "''",
                                        "error" =>  ""
                        ),
                        "password"  =>  array(
                                        "name"  =>  "password",
                                        "label" =>  "Password:",
                                        "type"  =>  "text",
                                        "value" =>  "''",
                                        "error" =>  ""
                        ),
                        "submit" =>  array(
                                        "name"  =>  "''",
                                        "label" =>  "<a style=font-size:14px; href='?page=register'>Register account</a>",
                                        "type"  =>  "submit",
                                        "value" =>  "'Log in'",
                                        "error" =>  ""
                        ),
                        "hidden" =>  array(
                                        "name"  =>  "page",
                                        "label" =>  "",
                                        "type"  =>  "hidden",
                                        "value" =>  "login",
                                        "error" =>  ""
                        )
                    ));
                break;
            case "register":
                require_once "form.php";
                $page = new Form(
                    title: "👤ACCOUNT",
                    header: "👤ACCOUNT",
                    navlinks: $navlinks,
                    author: $author,
                    form: "register",
                    method: "POST",
                    fields: array
                    (
                        "email" =>  array(
                                        "name"  =>  "email",
                                        "label" =>  "E-mail:",
                                        "type"  =>  "text",
                                        "value" =>  "''",
                                        "error" =>  ""
                        ),
                        "username" =>  array(
                                        "name"  =>  "username",
                                        "label" =>  "Username:",
                                        "type"  =>  "text",
                                        "value" =>  "''",
                                        "error" =>  ""
                        ),
                        "password"  =>  array(
                                        "name"  =>  "password",
                                        "label" =>  "Password:",
                                        "type"  =>  "text",
                                        "value" =>  "''",
                                        "error" =>  ""
                        ),
                        "rpassword"  =>  array(
                                        "name"  =>  "rpassword",
                                        "label" =>  "Repeat password:",
                                        "type"  =>  "text",
                                        "value" =>  "''",
                                        "error" =>  ""
                        ),
                        "submit" =>  array(
                                        "name"  =>  "''",
                                        "label" =>  "<a style=font-size:14px; href='?page=login'>Log in instead</a>",
                                        "type"  =>  "submit",
                                        "value" =>  "Register",
                                        "error" =>  ""
                        ),
                        "hidden" =>  array(
                                        "name"  =>  "page",
                                        "label" =>  "",
                                        "type"  =>  "hidden",
                                        "value" =>  "register",
                                        "error" =>  ""
                        )
                    ));
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