<h2 class="header">Reviews</h2>
<?php if (isset($_SESSION['username'])): ?>
<form method="post" id="reviewForm">
    <input type="hidden" name="username" value="<?= $_SESSION['username'] ?>" />
    <input type="hidden" name="movieId" value="<?= $movie->getId(); ?>" />
    <div class="form-group">
        <!-- <label for="reviewMessage">Message</label> -->
        <textarea id="reviewMessage" name="message" class="form-control" row="5"></textarea>
    </div>
  <button type="submit" class="btn btn-outline-success">Submit</button>
</form>
<?php else: ?>
    <div class="alert alert-warning">You must be logged in to submit a review.</div>
<?php endif; ?>

<?php 
    // Review submitted
    if (isset($_POST['message'])) {
        // Database::initialize();
        $newReview = new Review($_POST);
        $result = Database::saveReview($newReview);
        // Means there are errors
        if (is_array($result)) {
            foreach ($result as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        // Success
        } else { 
            echo '<div class="alert alert-success">Review has been saved!</div>';
        }
    }

    $reviews = Database::getMovieReviews($movie->getId());
?>

<!-- Display review section -->
<?php foreach ($reviews as $review): ?>
<div class="panel-body" style="margin-top: 10px;">
        <header class="text-left">
            <div class="comment-user"><i class="fa fa-user"></i> <?= $review['username'] ?></div>
            <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?= $review['date'] ?></time>
        </header>
        <div class="comment-post">
            <p>
                <?= $review['message'] ?>
            </p>
        </div>
    </div>
<?php endforeach; ?>