
<?php
// get_offers.php

include_once("../common/facade.php");
$offerDao = $factory->getOfferDao();
$quizDao = $factory->getQuizDao();
$respondentDao = $factory->getRespondentDao();

$limit = 2; // Number of offers per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$search = isset($_GET['search']) ? $_GET['search'] : ''; // Current search
$offset = ($page - 1) * $limit; // Calculate the offset

$offers = $offerDao->findAllWithSubmissionInfo($offset, $limit, $search);

if ($offers) {
  echo '<table class="table table-hover table-bordered">';
  echo '<thead class="thead-light">';
  echo '<tr>';
  echo '<th>Id</th>';
  echo '<th>Data</th>';
  echo '<th>Questionário</th>';
  echo '<th>Respondente</th>';
  echo '<th>E-mail Respondente</th>';
  echo '<th>Enviado</th>';
  echo '<th>Ações</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';

  foreach ($offers as &$offer) {
    $date = date('d/m/Y H:i', strtotime($offer->getDate()));
    echo '<tr>';
    echo '<td>' . $offer->getId() . '</td>';
    echo '<td>' . $date . '</td>';
    echo '<td>' . $quizDao->findById($offer->getQuiz()->getId())->getName() . '</td>';
    echo '<td>' . $respondentDao->findById($offer->getRespondent()->getId())->getName() . '</td>';
    echo '<td>' . $respondentDao->findById($offer->getRespondent()->getId())->getEmail() . '</td>';
    if ($offer->getSubmission() !== null) {
      echo '<td>';
      echo '<i class="fas fa-check text-success"></i>';
      echo '<p>Enviado em ' . date('d/m/Y H:i', strtotime($offer->getSubmission()->getDate())) . '</p>';
      echo '</td>';
    } else {
      echo '<td><i class="fas fa-times text-danger"></i></td>';
    }
    echo '<td>';
    if ($offer->getSubmission() !== null) {
      // Disable the button if offer has a submission
      echo '<button class="btn btn-info mr-1" disabled>';
      echo '<span class="fas fa-edit"></span> Alterar';
      echo '</button>';
    } else {
      // Enable the button if offer does not have a submission
      echo '<a href="/offers/update.php?id=' . $offer->getId() . '" class="btn btn-info mr-1">';
      echo '<span class="fas fa-edit"></span> Alterar';
      echo '</a>';
    }
    echo '<a href="/offers/delete.php?id=' . $offer->getId() . '" class="btn btn-danger mr-1" onclick="return confirm(\'Tem certeza que quer excluir?\')">';
    echo '<span class="fas fa-trash"></span> Excluir';
    echo '</a>';
    echo '</td>';
    echo '</tr>';
  }

  echo '</tbody>';
  echo '</table>';

  // Pagination links
  $total = $offerDao->countAll($search); // Total number of offers
  $totalPages = ceil($total / $limit); // Calculate total number of pages
  echo '<ul class="pagination">';
 
  for ($i = 1; $i <= $totalPages; $i++) {
    echo '<li class="page-item' . ($i == $page ? ' active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
  }
  
  echo '</ul>';
} else {
  echo '<p>No data found for "'.$search.'".</p>';
}
?>
