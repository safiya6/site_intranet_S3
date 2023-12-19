<?php 
Class Controller_user extends Controller{
    
    public function action_randomQuestion(){
      
        $m = Model::getModel();
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['q']) && isset($_POST['r'])) {
            $q = (int)$_POST['q'];
            $r = (bool)$_POST['r'];
         $m->answerQuestion($q, $r);
        }
      
       
        $data = [
            "randomQuestion" => $m->getRandomQuestion(),
        ];
      
        $this -> render("form",$data);
        
    
    } 

    public function action_results(){
        $m = Model::getModel();
        $data = [
            "results" => $m->getPopularQuestion(),
        ];
        $this -> render("results",$data);
    }
   
    
    
    public function action_default()
    {
        $this-> action_randomQuestion();
    
    }
}

?>