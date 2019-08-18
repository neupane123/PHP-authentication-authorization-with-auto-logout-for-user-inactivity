<?php
	session_start();
	if(!isset($_SESSION['login']) || !isset($_SESSION['name']))
	{
		header('location:login.php?msg=you need to login to access dashboard !');
		exit();
	}

?>

<div style="text-align: center; max-width: 800px;">
	<h4>Welcome to Dashboard <span style='color:red;'><?php echo $_SESSION['name']; ?></span></h4>
	<form action="logout.php" method="post">
		<button type="submit" name="logout" style="position: absolute; top:10; right: 10%;">Logout</button>
	</form>
	
</div>



<!-- jquery auto logout after 5 minutes -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
var idleTime = 0;
$(document).ready(function () {
    //Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 10000); // 1 minute

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });
});

function timerIncrement() {

    idleTime = idleTime + 1;
    if (idleTime > 5) { // 20 minutes (idleTime > 19)
        // window.location.reload();
       $.post(
       	"logout.php",{logout:'true'},
       	function(data,status){
       		console.log(data);
       		window.location = data;
       });
    }
}
</script>   