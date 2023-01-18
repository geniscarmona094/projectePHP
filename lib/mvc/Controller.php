<?php
    namespace lib\mvc;

    abstract class Controller{
        protected ?Model $model;

        public function __construct(){
            $this->model = null;
        }

        public function redirect(string $url, array $params = [], int $code = 302){
            if(!empty($params)){
                foreach($params as $key => $value){
                    $params[$key] = urlencode($key) . '=' . urlencode($value);
                }
                $params = implode('&',$params);
                $url .= '?' . $params;
            }
            header("HTTP/1.1 $code");
            header("Location: ".APP_BASE_URL.$url);
            return;
        }

        public function render(string $name,array $viewExtraParams = [],string $type = 'html'):string{
            //Obtenim dades del model
            $modelData = isset($this->model) ? $this->model->getViewData($name) : [];
            //Fusionem dades del model amb dades extra injectades pel controlador
            $modelData += $viewExtraParams;
            //Carreguem la vista
            $view = new View($name, $modelData, $type);
            $out  = $view->render();
            //Alliberem memòria una vegada carregada la vista
            unset($view);
            //Retornem la vista renderitzada
            return $out;
        }
    }