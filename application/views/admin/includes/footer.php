<div class="clearfix"></div>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- <script src="<?php echo base_url(); ?>assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendor/chartist/js/chartist.min.js"></script> -->
	<script src="<?php echo base_url(); ?>assets/scripts/klorofil-common.js"></script>
	<script src="<?php echo base_url(); ?>assets/scripts/bootstrap-datetimepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/scripts/custom.js"></script>
	<script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <script>
      $('#my_dtp').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        fontAwesome: true,
        wheelViewModeNavigation: true
      })
      $('#my_dtp').datetimepicker('update', new Date())

    </script>
	<script>
		CKEDITOR.replace( 'body' ,{
			height: 500,
			filebrowserBrowseUrl: '/admin/media/files',
    	filebrowserUploadUrl: '/admin/upload/upload',
			image_previewText: ' ',

		});
	</script>
</body>

</html>