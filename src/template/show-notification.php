<?php if(!empty($templateParams["notifications"])): ?>
    <?php foreach($templateParams["notifications"] as $notification): ?>
    <div class="notification container mb-2 p-3 rounded-5" data-id="<?php echo $notification["notification_id"]; ?>" <?php if($notification["visualized"]){ echo('style="opacity: 0.5;"'); } ?> >
        <div class="row">
            <div class="col-auto d-flex align-items-center">
                <?php if($notification["notification_type"] == "Follow"): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                </svg>
                <?php elseif($notification["notification_type"] == "Donation"): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" class="bi bi-piggy-bank-fill" viewBox="0 0 16 16">
                    <path d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069q0-.218-.02-.431c.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a1 1 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.74.74 0 0 0-.375.562c-.024.243.082.48.32.654a2 2 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595m7.173 3.876a.6.6 0 0 1-.098.21l-.044-.025c-.146-.09-.157-.175-.152-.223a.24.24 0 0 1 .117-.173c.049-.027.08-.021.113.012a.2.2 0 0 1 .064.199m-8.999-.65a.5.5 0 1 1-.276-.96A7.6 7.6 0 0 1 7.964 3.5c.763 0 1.497.11 2.18.315a.5.5 0 1 1-.287.958A6.6 6.6 0 0 0 7.964 4.5c-.64 0-1.255.09-1.826.254ZM5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0"/>
                </svg>
                <?php elseif($notification["notification_type"] == "Comment" || $notification["notification_type"] == "Reply"): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" class="bi bi-chat-fill" viewBox="0 0 16 16">
                    <path d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9 9 0 0 0 8 15"/>
                </svg>
                <?php elseif($notification["notification_type"] == "Like"): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg>
                <?php endif; ?>
            </div>
            <div class="col-7">
                <p class="mb-0">
                    @<?php 
                    echo $notification["username"];
                    switch($notification["notification_type"]) {
                        case "Follow":
                            echo(" has followed you");
                            break;
                        case "Donation":
                            echo(" has made a donation");
                            break;
                        case "Comment":
                            echo(" has commented");
                            break;
                        case "Reply":
                            echo(" replied to your comment");
                            break;
                        case "Like":
                            echo(" likes your idea");
                            break;
                        default:
                            echo("An error occurred");
                    }
                    ?>
                </p>
            </div>
            <div class="col d-flex justify-content-end align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" class="open-not bi bi-arrow-up-right-circle ms-2" viewBox="0 0 16 16" data-link="
                <?php 
                switch($notification["notification_type"]) {
                    case "Follow":
                        echo("profile.php?id=" . $notification["user_from_id"]);
                        break;
                    case "Donation":
                    case "Comment":
                    case "Reply":
                    case "Like":
                        echo("open-post.php?postId=" . $notification["post_id"]);
                        break;
                    default:
                }
                ?>
                ">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.854 10.803a.5.5 0 1 1-.708-.707L9.243 6H6.475a.5.5 0 1 1 0-1h3.975a.5.5 0 0 1 .5.5v3.975a.5.5 0 1 1-1 0V6.707z"/>
                </svg>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-center">There are no notifications :(</p>
<?php endif; ?>


