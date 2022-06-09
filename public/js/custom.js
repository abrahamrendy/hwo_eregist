$(document).ready(function(){
	// LOAD TYPE
    var checkAge = false;
    $('#regist-form').submit(function(e){
        if (!checkAge) {
            e.preventDefault();
            var age = $('input[name="age"]').val();

            if (age >= 6 && age <= 70) {
                checkAge = true;
                $('#regist-form').submit();
            } else {
                alert('Mohon maaf, umur anda tidak memenuhi kriteria (6-70 tahun) untuk mengikuti ibadah onsite.');
            }
        } else {

        }

    });

});