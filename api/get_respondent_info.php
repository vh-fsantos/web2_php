<?php
include_once("../common/facade.php");

header('Content-Type: application/json');

$id = $_GET['respondent_id'];

$daoRespondent = $factory->getRespondentDao();
$respondent = $daoRespondent->findById($id);

if ($respondent) {
    $daoOffer = $factory->getOfferDao();
    $offers = $daoOffer->findAllWithSubmissionInfoByRespondentId($id);

    $submittedQuizzes = array();

    foreach ($offers as $offer) {
        $submission = $offer->getSubmission();
        $quiz = $offer->getQuiz();
        
        if ($quiz && $submission) {
            $quizName = $quiz->getName();
            $submissionDate = $submission->getDate();
    
            $submittedQuizzes[] = array(
                'name' => $quizName,
                'submissionDate' => $submissionDate
            );
        }
    }

    $responseData = array(
        'id' => $respondent->getId(),
        'name' => $respondent->getName(),
        'login' => $respondent->getLogin(),
        'email' => $respondent->getEmail(),
        'phone' => $respondent->getPhone(),
        'submittedQuizzes' => $submittedQuizzes
    );

    $json = json_encode($responseData);
    echo $json;
} else {
    
    echo json_encode(array('error' => 'Respondent not found'));
}
?>
