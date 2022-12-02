<?php
	function ugras($hova,$mikor) {
		print '
			<script>
				setTimeout("window.location.href='."'$hova'".'",'.$mikor.');
			</script>
		';
	}
?>