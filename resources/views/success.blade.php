@include('header')
<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Pendaftaran Ibadah Onsite GBI Sukawarna</h2>
                </div>
                <div class="card-body">
                    <span style="font-weight: 600; font-size: 2.2rem; color: #560100">Terima kasih!<br><span style="font-size: 2rem; font-weight: 500; color: #453939">Pendaftaran anda berhasil.</span></span>

                    <br><br>

                    <div style="background-color: #ff4b5a; padding: 1.3em;text-align: center; line-height: 3.5em;border-radius: 18px;">
                        <h1 style="word-break: break-word; font-weight: 300;">No.urut: <?php echo $id;?></h1> 
                        <h1 style="word-break: break-word; font-weight: 300;">Nama: <?php echo $name;?></h1> 
                        <h1 style="word-break: break-word; font-weight: 300;">Worship Night Onsite</h1> 
                        <h3 style="word-break: break-word; font-style: italic; font-weight: 300;">Jl. Aruna no. 19</h3> 
                        <h3 style="word-break: break-word; font-style: italic; font-weight: 300;"><?php echo $attend_date.', 18.30 WIB'; ?></h3>  
                    </div>

                    <br><br>
                                    
                    <span style="font-size: 1.3em;">Kami akan mengirimkan email konfirmasi.<br>Mohon segera mengecek email anda.
                    <br>(email dapat dilihat di folder <span style="font-weight: 700">Inbox</span>/<span style="font-weight: 700">Spam</span>/<span style="font-weight: 700">Junk</span>).</span>

                    <br><br>

                    <div style="padding-top: 2%">
                        <a href="{{ route('index') }}">
                            <button type="button" class="btn btn--radius-2 btn--red" style="">
                                DAFTAR LAGI
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('footer')

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->