<?php 

include 'config/connect.php';

if(isset($_GET['id'])){
    //escape any malicious mysql code that might be inserted
    $id = mysqli_real_escape_string($connection, $_GET['id']);
    //create a query to get details with the id
    $query = "SELECT * FROM campsites WHERE _id = $id";
    //get the data with the query
    $result = mysqli_query($connection, $query);
    //get the data in an associated array
    $campsite = mysqli_fetch_assoc($result);
}

$comments = explode('&', $campsite['comments']); 
$error_msg = '';
$comment_str = '';

if(isset($_POST['action'])){
    if(empty($_POST['comment'])){
        $error_msg = "Cannot make an empty comment..";
    } else {
        $re = '/^[a-zA-Z0-9 !?.]+$/';
        $comnt = htmlspecialchars($_POST['comment']);
        $comnt = trim($comnt);
        if(preg_match($re, $comnt)){
            $comments[] = "$comnt";
            $comment_str = implode('&', $comments);
        } else {
            $error_msg = "Please use alphanumeric character(s), space(s) and period(s) only...";
        }
    }
}

if(!empty($comment_str)){
    //create update query
    $update_query = "UPDATE `campsites` SET `comments` = '$comment_str' WHERE `campsites`.`_id` = $id";
    //send update query to db
    if(mysqli_query($connection, $update_query)){
        echo "updated successfully";
    } else {
        echo "error". mysqli_error($connection);
    }
}

?>

<?php include 'templates/header.php';?>

<div class="container ">
    <div class="row card-panel large">
        <div class="col s12 m8">
            <img class="responsive-img card-panel large" src="<?php echo $campsite['img']; ?>" alt="camp_site_image">
        </div>
        <div class="col s12 m4 ">
            <h4 class="grey-text"><?php echo $campsite['title']; ?></h4>
            <p><?php echo $campsite['about']; ?></p>
            <div class="comment-area card small">
                <?php 
                foreach($comments as $comment):             
                ?>
                <p><?php echo $comment; ?></p><hr/>
                <?php endforeach; ?>
            </div>
            <div class="input-field">
                <form action="<?php echo "details.php?id={$campsite['_id']}" ;?>" method="post">
                    <label for="icon_prefix2">Add a comment...</label>
                    <textarea id="icon_prefix2" class="materialize-textarea" name='comment'></textarea>
                    <button class="right comment-btn" type="submit" name="action">
                        <i class="material-icons">send</i>
                    </button>
                    <?php if(!empty($error_msg)) { ?>
                        <span class="red-text error-msg"><?php echo $error_msg; ?></span>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>

</div>


<?php include 'templates/footer.php';?>
