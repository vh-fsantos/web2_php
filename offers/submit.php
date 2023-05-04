<?php

include_once("../common/facade.php");

$id = @$_POST["id"];
$quiz_id = @$_POST["quiz_id"];

$dao_answer = $factory->getAnswerDao();
$dao_alternative = $factory->getAlternativeDao();
$dao_submission = $factory->getSubmissionDao();
$dao_offer_answer = $factory->getOfferAnswerDao();

$dao_question = $factory->getQuestionDao();
$questions = $dao_question->findAllByQuizIdWithScores($quiz_id);


$offer = new Offer($id, null);

$total_score = 0;
$results_table = '';

// Loop over the received question IDs
foreach ($questions as $question) {
    $selected_alternatives = @$_POST['question_'.$question->getId()];

    $result_row = '<tr>';
    $result_row .= '<td>'.$question->getDescription().'</td>';

    // If the question is a single choice or multiple choice question
    if ($question->getQuestionType() == 'single_choice' || $question->getQuestionType() == 'multiple_choice') {
        $correct_alternatives = $dao_alternative->getCorrectAlternatives($question->getId());
        $result_row .= '<td>';
        if ($correct_alternatives) {
            $correct_alternative_ids = array_map(function($alternative) { return $alternative->getId(); }, $correct_alternatives);
            if (!is_array($selected_alternatives)) {
              $selected_alternatives = array_map('intval', explode(',', $selected_alternatives));
            }
            if ($correct_alternative_ids == $selected_alternatives) {
                $result_row .= '<span class="text-success">Correct</span>';
                $score += $question->getScore();
                $total_score+= $question->getScore();
            } else {
                $result_row .= '<span class="text-danger">Incorrect</span>';
            }
        } else {
            $result_row .= '<span class="text-warning">Not evaluated</span>';
        }
        $result_row .= '</td>';
    } else { // If the question is an essay question
        $result_row .= '<td>'.$selected_alternatives.'</td>';
    }

    $result_row .= '<td>'.$question->getScore().'</td>';
    $result_row .= '</tr>';
    $results_table .= $result_row;
}

$submission = new Submission(null, null);
$submission->setOffer($offer);
$dao_submission->create($submission);

$results_html = '
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Question</th>
                <th>Result</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            '.$results_table.'
        </tbody>
        <tfoot>
            <tr>
                <th>Total Score</th>
                <td colspan="2">'.$total_score.'</td>
            </tr>
        </tfoot>
    </table>
';

// echo $results_html;
session_start();
// Store the results HTML in the session
$_SESSION['results_html'] = $results_html;

// Redirect to the next page
header("Location: /offers/results.php");
exit;
?>
