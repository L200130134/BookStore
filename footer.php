
		<!-- Modal Error -->
		<div class="modal fade" id="error-result" role="dialog" style="margin-top: 15%;">
			<div class="modal-dialog modal-sm">
			
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title text-danger">Kegagalan Proses</h4>
				</div>
				<div class="modal-body">
				  <p class="text-danger"><?php echo $errorResult; ?> </p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Mengerti</button>
				</div>
			  </div>
			  
			</div>
		</div>	


      	<footer class="footer-custom">
			<hr>
        	<div class="text-muted pull-left">
            	<a href=""> Project KP </a>
        	</div>
        	<div class="text-muted pull-right">
          		<a href="admin.php">Admin Login</a> 2017
        	</div>
      	</footer>
    </div> <!-- /container -->


    <!-- Bootstrap core
    ================================================== -->
    <script type="text/javascript" src="./bootstrap/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./bootstrap/js/script.js"></script>
	
	<?php if($errorResult != ''){ ?>
		<script type="text/javascript"> $('#error-result').modal('show'); </script>
	<?php } ?>
  </body>
</html>