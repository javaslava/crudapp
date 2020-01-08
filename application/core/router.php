<?php

class Router
{
	 static function start()
	{
		$routes = explode('/', trim(REQUEST_URI, '/\\'));

		$controllerName = !empty($routes[0]) ? $routes[0] : 'Main';
		$actionName = !empty($routes[1]) ? $routes[1] : 'index';

		$controllerClassName = 'Controller_'.$controllerName;
		$action = 'action_'.$actionName;

		try{
			if(!class_exists($controllerClassName))
			{
				throw new Exception('Class name error');
			}
			$controller = new $controllerClassName;
				if(!method_exists($controller, $action))
				{
					throw new Exception('Method name error');
				}
				$controller -> $action();
		}
		catch(Exception $e){
			self :: errorPageCause($e->getMessage());
		}
	}

	static function errorPageCause($e){
		$controller = new Controller_errorPage($e);
		$controller -> action_index();
	}
}
