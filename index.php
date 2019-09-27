<?php 

include 'config/connect.php';

//write query for all camps 
$query = 'SELECT _id, title, location, about, img, comments FROM campsites';

//make query to my connection & get result
$result = mysqli_query($connection, $query);

//turn the result into an associative array 
$camps = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result from memory
mysqli_free_result($result);

//close connection
mysqli_close($connection); 


?>

<?php include 'templates/header.php'; ?>

 <h4 class="center grey-text"></h4>       

<div class="container">
    <div class="row">
        <?php foreach($camps as $camp): ?>
            <div class="col s12 m6">
                <div class="card large hoverable">
                    <div class="card-image">
                        <img src="<?php echo $camp['img'];?>" alt="">
                        <span class='card-title'><?php echo $camp['title'];?></span>
                    </div>
                    <div class="card-content">
                        <p><?php echo $camp['about'];?></p>                    
                    </div>
                    <div class="card-action right-align">
                        <span class="grey-text hoverable left">
                        <i class="material-icons">location_on</i><?php echo $camp['location']; ?>
                        </span>
                        <a href="details.php?id=<?=$camp['_id']?>">More info!</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>  
</div>

<?php include 'templates/footer.php'; ?>
