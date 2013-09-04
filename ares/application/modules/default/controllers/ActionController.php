<?php
class ActionController
{
    protected $_request;
    protected $_response;
    protected $_redirected;

    public static function process(Request $request, Response $response)
    {
        if (!file_exists($path = 'controllers/' . $request->getParam('controller') .'.php')){
            throw new ControleurIntrouvableException ('contrôleur introuvable');
        }
        require_once($path);
        $class = $request->getParam('controller') . 'Controller';
        $controller = new $class($request, $response);
        return $controller->launch();
    }

    public static function processException(Request $request, Response $response, Exception $e)
    {
        $controller = new self($request, $response);
        return $controller->launchException($e);
    }

    public function __construct(Request $request, Response $response)
    {
        $this->_request  = $request;
        $this->_response = $response;
        $this->_redirected = false;
    }

    private function _actionExists($action)
    {
        try{
            $method = new ReflectionMethod(get_class($this),$action);
            return ($method->isPublic() && !$method->isConstructor());
        }catch (Exception $e){
            return false;
        }
    }

    public function redirect($url)
    {
        if ($this->_redirected == true){
            throw new Exception('Une redirection a déja été demandée');
        }
        $this->_response->redirect($url);
        $this->_redirected = true;
    }

    private function _render($file)
    {
        $view = new View();
        $this->_response->setBody($view->render(dirname(__FILE__) . '/views/' . $file, $this->_response->getVars()));
    }

    public function __get($param)
    {
        return $this->_response->getVar($param);
    }

    public function __set($name,$param)
    {
        $this->_response->addVar($name, $param);
    }
    
    public function launch()
    {
        $action = $this->_request->getParam('action');
        if (!$this->_actionExists($action)){
            throw new ActionIntrouvableException('Action introuvable');
        }
        // prefiltering

        $this->$action();

        // postfiltering

        if (!$this->_redirected){
            $this->_render($this->_request->getParam('action') . '.php');
        }
        return $this->_response;
    }
    
    public function launchException(Exception $e)
    {
        if ($e instanceof MVCException){
            $this->_render('404.html');
        }else{
            $this->_render('500.php');
        }
        return $this->_response;
    }
}