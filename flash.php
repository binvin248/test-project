<?php if(isset($_SESSION['flash_msg'])){ 
    if(!isset($_SESSION['flash_err'])){ 
        $flash_err = "success";
    }else{
        $flash_err = "danger";
    }
    ?> 

<div class="alert alert-<?php echo $flash_err; ?>">
  <?php echo $_SESSION["flash_msg"];
        unset($_SESSION["flash_msg"]);
        unset($_SESSION["flash_err"]);?>
</div>
<?php } ?> 