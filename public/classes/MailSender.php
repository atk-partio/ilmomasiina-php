<?php

require_once("Email.php");

/**
 * Luokka, jonka avulla l�hetet��n ilmoittautumisvahvistusviesti
 * k�ytt�j�lle.
 *
 *
 * @author Mikko Koski (mikko.koski@tkk.fi)
 *
 * HUOM! EI viel� k�yt�ss� (13.3.2008) -mikko
 */
class ConfirmationMail{

	function ConfirmationMail()

	/**
	 * L�hett�� k�ytt�j�lle vahvistusviestin ilmoittautumisesta
	 *
	 * @param string message Viesti k�ytt�j�lle
	 * @param string email K�ytt�j�n email
	 * @param SignupGadget signupgadget Tiedot ilmosta
	 *        (Huom. t�m� ei ole pakollinen, jos ei haluta l�hett�� viestiss� ilmoittautumisen vastauksia)
	 */
	function sendConfirmationMail($message, Email $email, $signupGadget, $user_id){

		// Initializes the debugger
		$debugger = CommonTools::getDebugger();		

		if(!is_a($email, 'Email')){
			$debugger->error("email parameter must be an instance of Email class");
		}	

		$questions = $signupGadget->getAllQuestions();
		$allAnswers = $signupGadget->getAllAnswersByUsers();
		$answers = $allAnswers[$user_id];

		$message .= "\n\n*** Ilmoittautumisesi tiedot ***\n\n";

		foreach($questions as $question){
			// Gets answer to questin
			$answerObject = $answers->getAnswerToQuestion($question->getId());
			if(is_a($answerObject, "Answer")){
				$message .= $question->getQuestion() . ": " . $answerObject->getReadableAnswer() . "\n";
			} else {
				print($answerObject); die("Kuoltiin");
			}
		}

		print $message;
		
	}

	function previewMail(){

	}
}

?>
