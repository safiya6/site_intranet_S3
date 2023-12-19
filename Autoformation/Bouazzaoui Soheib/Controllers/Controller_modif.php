<?php 
Class Controller_modif extends Controller{

    public function action_addQuestion(){
      
        $m = Model::getModel();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['question']) && isset($_POST['pour'])&& isset($_POST['contre'])) {
           
            $question = (string)$_POST['question'];
            $pour = (int)$_POST['pour'];
            $contre = (int)$_POST['contre'];
         
            $m->createQuestion($question, $pour,$contre);
            header("Location: ?controller=user&action=randomQuestion");
            $this -> action_randomQuestion();
     
        }
        
        
       
        $this -> render("add");
        
    } 


    public function action_deleteQuestion(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            
            $m = Model::getModel();
            $id = (int)$_POST['id'];
            $data = $m -> getQuestionById($id);
 
            $this -> render("delete",$data);
        }
        else{
            header("Location: ?controller=user&action=randomQuestion");
            $this -> action_randomQuestion();
         
        }
    }

    public function action_confirmedDeleteQuestion(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idDelete']) && $_POST['idDelete']!=NULL ) {
            
            $m = Model::getModel();
            $id= (int)$_POST['idDelete'];
            $m -> deleteById($id);
            header("Location: ?controller=user&action=randomQuestion");
            $this -> action_randomQuestion();
        
            
        }
        else{
            header("Location: ?controller=user&action=randomQuestion");
            $this -> action_randomQuestion();
        }

    }

    

    
    
    public function action_default()
    {
        $this-> action_addQuestion();
    
    }
}

?>