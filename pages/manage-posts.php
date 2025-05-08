<?php



// TODO: 1. connect to database
  $database = connectToDB();
  // TODO: 2. get all the users
  // TODO: 2.1
  $sql = "SELECT * FROM posts";
  // TODO: 2.1
  $query = $database->query( $sql );
  // TODO: 2.3
  $query->execute();
  // TODO: 2.4
  $posts = $query->fetchAll();
?>

<?php require "parts/header.php"; ?>
<body>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Posts</h1>
        <div class="text-end">
          <a href="/posts-add" class="btn btn-primary btn-sm"
            >Add New Post</a
          >
        </div>
      </div>
      <!--success message-->
      <?php require "parts/message-success.php"; ?>
      <div class="card mb-2 p-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col" style="width: 40%;">Title</th>
              <th scope="col">Status</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>

          
          <!--for each-->
          <?php foreach ($posts as $index => $post) { ?>
        
            <?php if ( isEditor() || $post["user_id"] === $_SESSION["user"]["id"]) : ?>
            <tr>
              <th scope="row"><?php echo $index + 1; ?></th>
              <td><?php echo $post["title"]; ?></td>

              
              <?php if ($post["status"]=="Pending to review") {?>
              <td><span class="badge bg-warning"><?php echo $post["status"]; ?></span></td>

              <?php } else { ($post["status"]=="Publish") ?>
              <td><span class="badge bg-success"><?php echo $post["status"]; ?></span></td>
              <?php } ?>
              <td class="text-end">
                <div class="buttons">
                  <a
                    href="/post"
                    target="_blank"
                    class="btn btn-primary btn-sm me-2"
                    ><i class="bi bi-eye"></i
                  ></a>
                  <a
                    href="/posts-edit?id=<?php echo $post["id"]; ?>"
                    class="btn btn-secondary btn-sm me-2"
                    ><i class="bi bi-pencil"></i
                  ></a>

                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#userDeleteModal-<?php echo $post["id"]; ?>">
                  <i class="bi bi-trash"></i>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="userDeleteModal-<?php echo $post["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">
                          Are you sure you want to delete this post?</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                          This action cannot be reversed.
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                          <form 
                            method="POST" 
                            action="/post/delete">
                              <input type="hidden" name="user_id" value="<?php echo $post["id"]; ?>" />
                                <button class="btn btn-sm btn-danger">
                                  <i class="bi bi-trash me-2"></i>Delete
                                </button>
                          </form>
                </div>
              </td>
            </tr>
             <?php endif; ?>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="text-center">
        <a href="/dashboard" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Dashboard</a
        >
      </div>
    </div>
              
<?php require "parts/footer.php" ?>