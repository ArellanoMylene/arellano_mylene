<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #ffe6f0, #ffd6e0); /* soft feminine gradient */
      font-family: "Poppins", "Segoe UI", sans-serif;
    }
    .page-header h2 {
      color: #d63384;
      font-weight: 700;
    }
    .page-header p {
      color: #6c757d;
    }
    .card {
      border: none;
      border-radius: 20px;
      background: #fff;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }
    .table thead {
      background: linear-gradient(90deg, #d63384, #f78fb3);
      color: #fff;
    }
    .btn-custom {
      border-radius: 50px;
      font-weight: 500;
      padding: 6px 18px;
    }
    .btn-pink {
      background: linear-gradient(90deg, #d63384, #f78fb3);
      border: none;
      color: #fff;
    }
    .btn-pink:hover {
      background: linear-gradient(90deg, #b92f70, #e96c9f);
      color: #fff;
    }
    .modal-content {
      border-radius: 20px;
      border: none;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }
    .modal-header {
      border-bottom: none;
      background: linear-gradient(90deg, #d63384, #f78fb3);
      color: #fff;
      border-top-left-radius: 20px;
      border-top-right-radius: 20px;
    }
    .modal-footer {
      border-top: none;
    }
    .table-hover tbody tr:hover {
      background-color: #fff0f5; /* light pink hover */
    }

    /* --- NEW CSS FIXES --- */
    /* Search bar design */
    .search-box .input-group {
      border-radius: 50px;
      overflow: hidden;
      box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }
    .search-box input {
      border: none;
      box-shadow: none;
    }
    .search-box input:focus {
      box-shadow: none;
    }
    .search-btn {
      background: linear-gradient(90deg, #d63384, #f78fb3);
      border: none;
      color: #fff;
      padding: 0 20px;
    }
    .search-btn:hover {
      background: linear-gradient(90deg, #b92f70, #e96c9f);
    }

    /* Space between table and pagination */
    .pagination {
      margin-top: 20px;
    }

    /* Add spacing between pagination items */
    .pagination li {
      margin: 0 5px;
    }

    .pagination {
        background-color: pink; /* Change this to your desired color */
        border-radius: 5px;
    }

    .pagination li {
        margin: 0 2px;
    }

    .pagination .page-item.active .page-link {
        background-color: hotpink; /* Active page color */
        border-color: hotpink;
    }

    .pagination .page-link {
        color: black; /* Adjust text color */
    }

    .pagination .page-link:hover {
        background-color: lightpink; /* Hover effect color */
        color: white;
    }


    .page
  </style>
</head>
<body>

<div class="container py-5">
  <!-- Page Header -->
  <div class="page-header text-center mb-4">
    <h2>👩‍🦰User Management👨</h2>
  </div>

  <!-- Alerts -->
  <div class="mb-3">
    <?php getErrors(); ?>
    <?php getMessage(); ?>
  </div>
    

  <!-- Search on Left & Add Button on Right -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <?php
      $q = '';
      if (isset($_GET['q'])) {
        $q = $_GET['q'];
      }
    ?>
    <form action="<?= site_url('/'); ?>" method="get" class="search-box mb-0">
      <div class="input-group" style="max-width: 400px;">
        <input type="text" name="q" class="form-control" placeholder="🔍 Search user..." value="<?= html_escape($q); ?>">
        <?php if (!empty($q)): ?>
          <a href="<?= site_url('/'); ?>" class="btn btn-outline-secondary">Clear</a>
        <?php endif; ?>
        <button type="submit" class="btn search-btn">Search</button>
      </div>
    </form>
    <button class="btn btn-pink btn-custom shadow-sm" data-bs-toggle="modal" data-bs-target="#addModal">
      ➕ Add User
    </button>
  </div>

  <!-- Table Card -->
  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table table-hover align-middle mb-0 text-center">
        <thead>
          <tr>
            <th>🌸 First Name</th>
            <th>🌸 Last Name</th>
            <th>📧 Email</th>
            <th>📅 Created At</th>
            <th>⏱ Updated At</th>
            <th>⚙️ Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($all)): ?>
            <?php foreach($all as $user): ?>
              <tr>
                <td><?= htmlspecialchars($user['first_name']); ?></td>
                <td><?= htmlspecialchars($user['last_name']); ?></td>
                <td><?= htmlspecialchars($user['email']); ?></td>
                <td><?= htmlspecialchars($user['created_at']); ?></td>
                <td><?= htmlspecialchars($user['updated_at']); ?></td>
                <td>
                  <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $user['id']; ?>">Edit</button>
                  <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $user['id']; ?>">Delete</button>
                </td>
              </tr>

              <!-- Edit Modal -->
              <div class="modal fade" id="editModal<?= $user['id']; ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <form action="/update-user/<?= $user['id']; ?>" method="POST">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $user['id']; ?>">
                        <div class="mb-3">
                          <label class="form-label">First Name</label>
                          <input type="text" name="first_name" class="form-control" value="<?= $user['first_name']; ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Last Name</label>
                          <input type="text" name="last_name" class="form-control" value="<?= $user['last_name']; ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Email</label>
                          <input type="email" name="email" class="form-control" value="<?= $user['email']; ?>" required>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-pink btn-custom">Update</button>
                        <button type="button" class="btn btn-light btn-custom" data-bs-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- Delete Modal -->
              <div class="modal fade" id="deleteModal<?= $user['id']; ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <form action="/delete-user/<?= $user['id']; ?>" method="POST">
                      <div class="modal-header bg-danger text-white rounded-top">
                        <h5 class="modal-title">Delete User</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure you want to delete <strong><?= $user['first_name'] . " " . $user['last_name']; ?></strong>?</p>
                        <input type="hidden" name="id" value="<?= $user['id']; ?>">
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-custom">Delete</button>
                        <button type="button" class="btn btn-light btn-custom" data-bs-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="text-muted">No users found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Pagination -->
  <div class="d-flex justify-content-center">
    <?php echo $page; ?>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="/create-user" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Add User</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-pink btn-custom">Add</button>
          <button type="button" class="btn btn-light btn-custom" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL; ?>/public/js/alert.js"></script>
</body>
</html>

