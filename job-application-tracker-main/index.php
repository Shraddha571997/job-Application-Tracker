<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM jobs");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Job Applicant Tracker</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body class="container mt-5">

  <h2 class="mb-4">Job Applications
    <a href="logout.php" class="btn btn-danger btn-sm float-right" data-toggle="tooltip" title="Logout">
      <i class="fas fa-sign-out-alt"></i> Logout
    </a>
  </h2>

  <a href="create.php" class="btn btn-success mb-3" data-toggle="tooltip" title="Add New Job">
    <i class="fas fa-plus-circle"></i> Add New Job
  </a>

  <table class="table table-striped table-hover">
    <thead class="thead-dark">
      <tr>
        <th>ID</th>
        <th>Company</th>
        <th>Position</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['company']) ?></td>
        <td><?= htmlspecialchars($row['position']) ?></td>
        <td><?= htmlspecialchars($row['status']) ?></td>
        <td>
          <!-- Edit Button -->
          <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $row['id']; ?>" data-toggle="tooltip" title="Edit Job">
            <i class="fas fa-edit"></i>
          </a>

          <!-- Delete Button -->
          <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $row['id']; ?>" data-toggle="tooltip" title="Delete Job">
            <i class="fas fa-trash"></i>
          </a>
        </td>
      </tr>

      <!-- Edit Modal -->
      <div class="modal fade" id="editModal<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form action="edit.php" method="post">
              <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="editModalLabel<?= $row['id']; ?>"><i class="fas fa-edit"></i> Edit Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                <div class="form-group">
                  <label>Company</label>
                  <input type="text" name="company" class="form-control" value="<?= htmlspecialchars($row['company']); ?>" required>
                </div>
                <div class="form-group">
                  <label>Position</label>
                  <input type="text" name="position" class="form-control" value="<?= htmlspecialchars($row['position']); ?>" required>
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option value="Interested" <?= $row['status'] == 'Interested' ? 'selected' : '' ?>>Interested</option>
                    <option value="Applied" <?= $row['status'] == 'Applied' ? 'selected' : '' ?>>Applied</option>
                    <option value="Interview" <?= $row['status'] == 'Interview' ? 'selected' : '' ?>>Interview</option>
                    <option value="Offer" <?= $row['status'] == 'Offer' ? 'selected' : '' ?>>Offer</option>
                    <option value="Rejected" <?= $row['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Delete Modal -->
      <div class="modal fade" id="deleteModal<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form method="post" action="delete.php">
              <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel<?= $row['id']; ?>"><i class="fas fa-exclamation-triangle"></i> Confirm Deletion</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Are you sure you want to delete the job at <strong><?= htmlspecialchars($row['company']); ?></strong> for the position of <strong><?= htmlspecialchars($row['position']); ?></strong>?
                <input type="hidden" name="id" value="<?= $row['id']; ?>">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" name="confirm_delete">
                  <i class="fas fa-trash"></i> Delete
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <?php } ?>
    </tbody>
  </table>

  <footer class="text-center mt-5 py-3 bg-dark text-white">
    <p>&copy; <?= date('Y'); ?> Job Applicant Tracker. All Rights Reserved.</p>
  </footer>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
</body>
</html>
