<?php 
interface imyTemplate {
    /* Renders a page with the common predefined templates
    * @param (string) $contentFile - The file to render
    * @param (array) $variables - Dictionary with the variables to be sent to the template
    */
    function render($contentFile, $variables=array());
}

class myTemplate implements imyTemplate {

    function render($contentFile, $variables = array())
    {
        # IF TESTING ACTIVE DONT RENDER PAGES
        if(defined("TESTING"))
            return ;

        $contentFileFullPath = TEMPLATES_PATH . "/pages/" . $contentFile;
    
        if (count($variables) > 0) {
            foreach ($variables as $key => $value) {
                if (strlen($key) > 0) {
                    ${$key} = $value;
                }
            }
        }
     
        require_once(TEMPLATES_PATH . "/header.php");

        if($_SESSION['valid_login'])
            require_once(TEMPLATES_PATH . "/navbarAfterLogin.php");
        else
            require_once(TEMPLATES_PATH . "/navbarBeforeLogin.php");
     
        if (file_exists($contentFileFullPath)) {
            require_once($contentFileFullPath);
        } else {
            /*
                If the file isn't found the error can be handled in lots of ways.
                In this case we will just include an error template.
            */
            require_once(TEMPLATES_PATH . "/error.php");
        }
        
        require_once(TEMPLATES_PATH . "/footer.php");
    }

}
?>