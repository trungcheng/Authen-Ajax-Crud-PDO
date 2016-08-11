<?php
	session_start();
	if(isset($_SESSION['user'])){
		unset($_SESSION['user']);
	}
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
	if(sessionStorage["user"] != null){
		sessionStorage.clear();
		window.location = 'index.php';
	}
</script>