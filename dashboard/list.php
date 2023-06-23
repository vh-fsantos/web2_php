<?php 

$page_title = "Dashboard";

include_once("../common/facade.php");
include_once("../common/header.php");

$quizDao = $factory->getQuizDao();
$quizzes = $quizDao->findAll(null, null, '');

$offerDao = $factory->getOfferDao();
$offers = $offerDao->findAll();

$submissionDao = $factory->getSubmissionDao();
$submissions = $submissionDao->findAll();

// Prepare data for chart
$chartLabels = array();
$chartDataOffers = array();
$chartDataSubmissions = array();

foreach ($quizzes as $quiz) {
    $quizId = $quiz->getId();
    $chartLabels[] = $quiz->getName();

    $offerCount = 0;
    foreach ($offers as $offer) {
        if ($offer->getQuiz()->getId() == $quizId) {
            $offerCount++;
        }
    }
    $chartDataOffers[] = $offerCount;

    $submissionCount = 0;
    foreach ($submissions as $submission) {
        if ($submission->getOffer()->getQuiz()->getId() == $quizId) {
            $submissionCount++;
        }
    }
    $chartDataSubmissions[] = $submissionCount;
}

?>

<section class="container mt-4">
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Questionário</th>
                    <th>Ofertas</th>
                    <th>Submissões</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($quizzes as $index => $quiz) { ?>
                    <tr>
                        <td><?php echo $quiz->getName(); ?></td>
                        <td><?php echo $chartDataOffers[$index]; ?></td>
                        <td><?php echo $chartDataSubmissions[$index]; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<div class="container mt-4">
    <canvas id="chart"></canvas>
</div>

<?php 
include_once("../common/footer.php"); 
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Create a bar chart
    var ctx = document.getElementById('chart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($chartLabels); ?>,
            datasets: [
                {
                    label: 'Ofertas',
                    data: <?php echo json_encode($chartDataOffers); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Submissões',
                    data: <?php echo json_encode($chartDataSubmissions); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
