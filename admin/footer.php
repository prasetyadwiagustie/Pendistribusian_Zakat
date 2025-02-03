<!-- Footer Section -->
<!-- Footer Section -->
<footer id="footer" class="bg-black text-white py-4 w-100" style="position: fixed; bottom: 0; left: 0; width: 100%; z-index: 10; transition: transform 0.3s ease;">
    <div class="container1" style="background-color:black; padding-left: 200px; padding-right: 50px; padding-top:10px">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0" style="color: white;">&copy; 2022 Inisiatif Zakat Indonesia</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0" style="color: white;">Lembaga Amil Zakat Nasional</p>
                <p class="mb-0" style="color: white;">Surat Keputusan Kementerian Agama RI Nomor 950 Tahun 2020</p>
            </div>
        </div>
    </div>
</footer>

<!-- Add some padding to the body to avoid content overlap -->
<style>
    body {
        padding-bottom: 80px; /* Adjust this based on the height of your footer */
    }
</style>

<!-- JS Script for scroll-based footer behavior -->
<script>
    let lastScrollTop = 0;
    const footer = document.getElementById('footer');

    window.addEventListener('scroll', function() {
        let currentScroll = window.pageYOffset || document.documentElement.scrollTop;
        
        // If user is scrolling down, show the footer
        if (currentScroll > lastScrollTop) {
            footer.style.transform = 'translateY(0)'; // Hide footer
        } else {
            footer.style.transform = 'translateY(100%)'; // Show footer
        }
        
        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Prevent negative scroll values
    });
</script>


<!-- JS Scripts -->
<script type="text/javascript" src="../assets/js/jquery.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
<script type="text/javascript" src="../assets/js/dataTables.min.js"></script>

<script type="text/javascript">
    $('#myModal').modal('show');
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>

<!-- Modal & Batal Scripts -->
<script type="text/javascript">
    $('#myModal').modal('show');
    $('.batal').click(function(){
        $('#nama').val(null);
        $('.hp').val(null);
        $('.alamat').val(null);
    });
</script>

</body>
</html>
