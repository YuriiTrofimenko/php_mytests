<?php
namespace app\models\session;
//
class Hour {
    //
    public $userName;
    //
    public $currentTestId;
    //
    public $currentQuestionIndex;
    //
    public $currentTestQCount;
    //
    public $score;
    //Конструктор
    function __construct(
            $userName
        	, $currentTestId = null
            , $currentQuestionIndex = null
            , $currentTestQCount = null
            , $score = null
        ) {
        $this->userName = $userName;
        $this->currentTestId = $currentTestId;
        $this->currentQuestionIndex = $currentQuestionIndex;
        $this->currentTestQCount = $currentTestQCount;
        $this->score = $score;
    }
}