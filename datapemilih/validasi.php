<?php
//perintah untuk menjalankan aksi ketika form disubmit disini
?>

<form id="myform" onSubmit="return validasi()">
    NIP : 
    <input type="text" name="nip" id="nip"/>
    <input type="submit" value="simpan" />
</form>

<script type="text/javascript">
// fungsi yang dipanggil ketika form di submit
// lihat baris 5 onSubmit
function validasi()
    {
//        menangkap variabel nip dari form, 
//        my form adalah id dari form, lihat baris 5
//        nip adalah id inputan, lihat baris 6
        var nip=document.forms["myform"]["nip"].value;
        
//        membuat variabel numbers bernilai angka 0 s/d 9
        var numbers=/^[0-9]+$/;
        
//        validasi nip tidak boleh kosong (required)
        if (nip==null || nip=="")
          {
          alert("NIP tidak boleh kosong !");
          return false;
          };
          
//        validasi nip harus berupa angka
//        dengan membandingkan dengan variabel number yang dibuat pada baris 21
        if (!nip.match(numbers))
          {
          alert("NIP harus angka !");
          return false;
          };
          
//        validasi nip harus 18 digit pakai length javascript
        if (nip.length!=18)
          {
          alert("NIP harus 18 digit");
          return false;
          };
          
//         jika ada validasi untuk inputan lain letakkan disini
//        ...
     }
</script>