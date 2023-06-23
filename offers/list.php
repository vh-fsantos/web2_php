
<?php
  
  $page_title = "Listagem de Ofertas";
  include_once("../common/facade.php");
  include_once("../common/header.php");
  $isAdmin = FALSE;
  if (!$developer) {
      header("location: /index.php");
      exit;
  }
  $isAdmin = $_SESSION["isAdmin"]; 
?>
  
  
  
 

<section class="container mt-4">
  <a href="/offers/new.php" class="btn btn-primary mb-3">
    <span class="fas fa-plus"></span> Criar
  </a>

  <div class="form-group">
    <input type="text" id="searchInput" class="form-control" placeholder="Pesquisar por nome ou email">
    <button id="searchButton" class="btn btn-primary mt-3">Pesquisar</button>
  </div>

  <div id="table" class="table-responsive">
    <!-- Table content will be loaded here -->
  </div>

  <nav id="pagination" aria-label="Pagination">
    <ul class="pagination justify-content-center">
      <!-- Pagination links will be loaded here -->
    </ul>
  </nav>
</section>

<script>
  $(document).ready(function() {
    loadTable(1); // Load initial offers data

    function loadTable(page, search = null) {
      $.ajax({
        url: 'get.php',
        type: 'GET',
        data: { page: page, search: search },
        dataType: 'html',
        success: function(data) {
          $('#table').html(data); // Update table content
        }
      });
    }

    $(document).on('click', '.pagination .page-link', function(e) {
      e.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      var search = $('#searchInput').val(); // Get search term from input field
      loadTable(page, search);
    });

    $('#searchButton').click(function(e) {
      e.preventDefault();
      var search = $('#searchInput').val(); // Get search term from input field
      loadTable(1, search); // Load offers with search term
    });
  });
</script>


<?php 
include_once("../common/footer.php");
?>