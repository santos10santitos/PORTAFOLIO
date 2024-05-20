<?php include("db.php"); ?>
<?php include('includes/header.php'); ?>

<main class="container p-4">
  <div class="row">
    <div class="col-md-4">
      <!-- MESSAGES -->
      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php session_unset(); } ?>

      <!-- ADD TASK FORM -->
      <div class="card">
        <div class="card-header bg-success text-white">
          <h5 class="mb-0">Agregar Nueva Idea</h5>
        </div>
        <div class="card-body">
          <form action="save_task.php" method="POST" class="needs-validation" novalidate>
            <div class="form-group mb-3">
              <input type="text" name="title" class="form-control" placeholder="Nombre" required>
              <div class="invalid-feedback">Por favor, ingrese un nombre.</div>
            </div>
            <div class="form-group mb-3">
              <textarea name="description" rows="3" class="form-control" placeholder="Idea" required></textarea>
              <div class="invalid-feedback">Por favor, ingrese una descripción.</div>
            </div>
            <button type="submit" name="save_task" class="btn btn-success w-100">Guardar Idea</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Lista de Ideas</h5>
        </div>
        <div class="card-body p-0">
          <table class="table table-bordered mb-0">
            <thead class="table-dark">
              <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Actualizar/Borrar</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT * FROM task";
              $result_tasks = mysqli_query($conn, $query);    

              while($row = mysqli_fetch_assoc($result_tasks)) { ?>
              <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['created_ad']; ?></td>
                <td>
                  <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="delete_task.php?id=<?php echo $row['id']?>" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p>&copy; 2024 Envia tus Ideas. Todos los derechos reservados.</p>
  </footer>
</main>

<?php include('includes/footer.php'); ?>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script>
  (function () {
    'use strict'

    var forms = document.querySelectorAll('.needs-validation')

    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
  })()
</script>
