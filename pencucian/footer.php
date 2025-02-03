<!-- js -->
<script type="text/javascript" src="../assets/js/jquery.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
<script type="text/javascript" src="../assets/js/dataTables.min.js"></script>

<script type="text/javascript">
	$('#myModal').modal('show')
    $(document).ready(function(){
        $('#tabel-data').DataTable()
    });
</script>

<!--Modal & Batal-->

<script type="text/javascript">
	$('#myModal').modal('show')
	$('.batal').click(function(){
		$('#nama').val(null)
		$('.hp').val(null)
        $('.alamat').val(null)
	})
</script>



</body>
</html>