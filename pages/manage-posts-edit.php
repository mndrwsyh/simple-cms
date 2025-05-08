<?php   

  // TODO: 1. connect to database
  $database = connectToDB();
//get id from url
  $id = $_GET["id"];
  // TODO: 2. get all the users
  // TODO: 2.1
  $sql = "SELECT * FROM posts WHERE id=:id";
  // TODO: 2.1
  $query = $database->prepare( $sql );
  // TODO: 2.3
  $query->execute([
    "id" => $id
  ]);
  // TODO: 2.4
  $post = $query->fetch();
?>
<?php require "parts/header.php"; ?>
<div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit Post</h1>
      </div>
      <div class="card mb-2 p-4">
        <form method="POST" action="/post/update">
      <?php require "parts/message-error.php"; ?>
          <div class="mb-3">
            <label for="post-title" class="form-label">Title</label>
            <input
              type="text"
              class="form-control"
              id="post-title"
              value="<?php echo $post["title"]; ?>"
              name="post-title"
            />
          </div>
          <div class="mb-3">
            <label for="post-content" class="form-label">Content</label>
            <textarea class="form-control" id="post-content" name="post-content" rows="10"><?php echo $post["content"]; ?></textarea
            >
          </div>
          <div class="mb-3">
            <label for="post-content" class="form-label">Status</label>
            <select class="form-control" id="post-status" name="post-status">
              <option value="Pending to review" <?php echo ( $post["status"] === "Pending to review" ? "selected" : "" ); ?>>Pending for Review</option>
              <option value="Publish" <?php echo ( $post["status"] === "Publish" ? "selected" : "" ); ?>>Publish</option>
            </select>
          </div>
          <div class="text-end">
            
          <input type="hidden" id="id" name="id"value="<?php echo $post["id"]; ?>"/>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/posts" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Posts</a
        >
      </div>
    </div>
<?php require "parts/footer.php" ?>