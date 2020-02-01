<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
	function getPageWO() {
		$('#halaman_ekonomi').html('<img src="https://wpamelia.com/wp-content/uploads/2018/11/ezgif-2-6d0b072c3d3f.gif" />');
		var modul = 'ekonomi';
		jQuery.ajax({
			url: "<?php echo site_url(); ?>mobile/App/ajax_page",
			data: {modul:modul},
			type: "POST",
			success:function(data){
				$('#halaman_ekonomi').html(data);
				$("#loading-image").hide();
			}
		});
	}
	getPageWO();
</script>
<img id="loading-image" src="https://wpamelia.com/wp-content/uploads/2018/11/ezgif-2-6d0b072c3d3f.gif" width='100%'/>
<div id="halaman_ekonomi">
</div>  