<?php
    class Welcome extends Controller
    {
        public function index()
        {
            //var_dump(filter_input(INPUT_GET, 'route', FILTER_SANITIZE_SPECIAL_CHARS));exit;
            //var_dump(apache_request_headers());exit;
            //var_dump($_COOKIE);exit;
            
            //var_dump($this->request->get(NULL));
            
            
            $time = microtime(true);
            
            for ($index = 0; $index < 1000000; $index++) {
                
            }
            
            $finalTime = microtime(true);
            
            
           echo ($finalTime - $time) / 60;
            /*
            $data = array('nome' => 'Carlos', 'idade' => 27);
            $this->response->setOutput('Foi');

            $this->load->model('welcome_m');

            var_dump($this->welcome_m->helloWorld());exit;

            $this->load->view('common/header');
            $this->load->view('body', array('body' => 'Corpo'));
            $this->load->view('footer');*/
        }
    }
?>