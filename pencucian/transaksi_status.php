<?php include 'header2.php'; ?>

<?php 

// koneksi database
include '../koneksi.php';
?>
<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4>Update Status Transaksi Laundry</h4>
		</div>
		<div class="panel-body">
        <div class="col-md-8 col-md-offset-2">
			<a href="transaksi.php" class="btn btn-sm btn-info pull-right">Kembali</a>
			<br/>
            <br/>
            	
            <form method="post" action="transaksi_update.php">
            <div class="form-group alert alert-info">
                <label>Status</label>
                <select class="form-control" name="status" required="required">																				
                    <option <?php if($t['transaksi_status']=="1"){echo "selected='selected'";} ?> value="1">DI CUCI</option>																		
                </select>				
            </div>	
            <input type="submit" class="btn btn-primary" value="Simpan">
            </form>
            
        </div>
        </div>
    </div>
</div>
    