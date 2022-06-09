@include('header')
<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Pendaftaran Worship Night Onsite GBI Sukawarna</h2>
                </div>
                <div class="card-body">
                    <?php 
                        $date = date("Y-m-d H:i:s", strtotime ("+7 hours"));
                        $dateDay = date("w", strtotime ("+7 hours"));
                        // if (false) {
                        // if ($date < date("Y-m-d H:i:s", strtotime ("This saturday 18.00")) && $dateDay != date("w", strtotime ("sunday"))) {
                        if ($date < date("Y-m-d H:i:s", strtotime ("This sunday 12.00"))) {
                    ?>
                        <form action="{{route('submit_register')}}" method="POST" id="regist-form">
                        @csrf
                        <div class="form-row m-b-55">
                            <div class="name">Nama</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="first_name" required>
                                            <label class="label--desc">nama depan</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="last_name">
                                            <label class="label--desc">nama belakang</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Usia</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number" name="age" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Alamat</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="address" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">No. Telp</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="phone" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Asal Gereja</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="service" required id="service">
                                            <option disabled="disabled" selected="selected">Pilih Gereja</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Beban Doa<br><span style="font-weight: normal; font-size: 14px; display: none">(akan didoakan bersama-sama di akhir ibadah)</span></div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <textarea class="input--style-5" name="pokok_doa" style="width: 100%; border: none"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row p-t-20" style="display: none">
                            <label class="label label--block">Are you an existing customer?</label>
                            <div class="p-t-15">
                                <label class="radio-container m-r-55">Yes
                                    <input type="radio" checked="checked" name="exist">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container">No
                                    <input type="radio" name="exist">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <button id="submit-btn" class="btn btn--radius-2 btn--red" type="submit">Daftar</button>
                        </div>
                    </form>
                    <?php } else { ?>
                        <span style="font-weight: 600; font-size: 2.2rem; color: #560100">Mohon maaf,<br>
                        <span style="font-size: 1.8rem; font-weight: 500; color: #453939">Pendaftaran untuk ibadah ini telah ditutup. Silakan mendatangi langsung cabang yang bersangkutan. Terima kasih, Tuhan Yesus memberkati.</span></span>
                        <!--<span style="font-size: 1.8rem; font-weight: 500; color: #453939">Ibadah onsite minggu ini ditiadakan dan dialihkan ke Ibadah Online melalui YouTube channel GBI Sukawarna. Terima kasih, Tuhan Yesus memberkati.</span></span>-->
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    @include('footer')
    
    <script>
        $(document).ready(function(){
            console.log ($('#service').val());
            // LOAD TYPE
            $.ajax(
                  {
                    url: base_url + '/get_services',
                    type:'GET',
                    dataType : "json",
                    success:function(data)
                    {
                        $('#service').text('');
                        var html = '<option disabled="disabled" selected="selected">Pilih Gereja</option>';
                        $.each(data, function(index, item) {
                            html += "<option value='"+item.id+"'>"+item.name+"</option>";
                        });
                        $('#service').append(html);
                    },
                    error:function(xhr,status,error)
                    {
                        alert("Please try again later.");
                    }
                  });
        });
    </script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->