<?php

class QuestionsController extends BaseController
{

    private $db;

    public function onInit()
    {
        $this->title = "Questions";
        $this->db = new QuestionsModel();
    }

    public function index()
    {

        $this->questions = $this->db->getAll();

    }

    public function viewQuestion($id)
    {
        $this->questions = $this->db->viewQuestion($id);
        $this->answers = $this->db->viewQuestionAnswers($id);
    }



    public function create()
    {
        $this->title = "Ask a question";
        if ($this->isPost) {
            $userId = $_SESSION['userId'];
            $title = $_POST['questionTitle'];
            $content = $_POST['questionContent'];
            $this->questions = $this->db->createQuestion($userId, $title, $content);
            $this->redirectToUrl('questions');

        }
    }

    public function createAnswer($inputQuestionId)
    {
        $this->title = "Answer the question";
        $this->questionId = $inputQuestionId;

        if ($this->isPost) {
            $theQuestionId = $_POST['theQuestionId'];
            $userId = $_SESSION['userId'];
            $content = $_POST['answerContent'];
            $this->answers = $this->db->createAnswer($theQuestionId, $userId, $content);
            $this->redirect('questions');
        }
    }

//    public function delete($id)
//    {
////        $this->renderView("index");
//        $this->db->deleteQuestion($id);
//        $this->redirect('questions');
//    }
}
