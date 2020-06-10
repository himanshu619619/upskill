<?php
if(!empty($error_msg)){
    echo '<p class="error">'.$error_msg.'</p>';    
}
?>

<?php if(!empty($userData)){ ?>
  <div class="wrapper">
      <h1>Twitter Profile Details</h1>
      <div class="welcome-txt">Welcome <b><?php echo $userData['fname']; ?></b></div>
      <div class="tw-box">
        <!-- Display profile information -->
        <p class="img">
          <img src="<?php echo $userData['picture_url']; ?>" />
        </p>
        <p><b>Twitter Username : </b><?php echo $userData['username']; ?></p>
        <p><b>Name : </b><?php echo $userData['fname'].' '.$userData['lname']; ?></p>
        <p><b>Locale : </b><?php echo $userData['address']; ?></p>
        <p>
          <b>Twitter Profile Link : </b>
          <a href="<?php echo $userData['profile_url']; ?>" target="_blank"><?php echo $userData['link']; ?></a>
        </p>
        <p><b>You are logged in with : </b>Twitter</p>
        <p><b>Logout from <a href="<?php echo base_url('twitter_authentication/logout/'); ?>">Twitter</a></b></p>
        
        <!-- Display latest tweets -->
        <?php if(!empty($tweets)){ ?>
        <div class="tweetList">
          <strong>Latest Tweets : </strong>
          <ul>
          <?php
            foreach($tweets  as $tweet){
              '<li>'.$tweet->text.' <br />-<i>'.$tweet->created_at.'</i></li>';
            }
          ?>
          </ul>
        </div>
        <?php } ?>
      </div>
  </div>
<?php }else{ ?>
  <!-- Display sign in button -->
  <a href="<?php echo $oauthURL; ?>"><img src="<?php echo base_url('assets/images/sign-in-with-twitter.png'); ?>" /></a>
<?php } ?>