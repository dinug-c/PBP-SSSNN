function validateForm() {
    var kelas = document.getElementById("kelas").value;
    var esktra = document.getElementsByName("esktrakur[]").value;
    //validasi name tidak boleh kosong
    if (document.forms["form_siswa"]["nama_siswa"].value == "") {
        alert("Please fill your name.");
        document.forms["form_siswa"]["nama_siswa"].focus();
        return false;
    }

    if (kelas == "") {
        alert("Please fill your class.");
        document.getElementById("kelas").focus();
        return false;
    } else {
        if (kelas == "X") {
            if (esktra.length < 1) {
                alert("Please fill your extracurricular.");
                document.getElementById("esktrakur[]").focus();
                return false;
            }
        } else if (kelas == "XI") {
            if (esktra.length > 2) {
                alert("Please fill your extracurricular.");
                document.getElementById("esktrakur[]").focus();
                return false;
            }
        } else {
            if (esktra.length > 0) {
                alert("Tidak boleh mengikuti ekstra");
                document.getElementById("esktrakur[]").focus();
                return false;
            }
        }
    }

    alert('Success! Thank you for filling the form.')
    return true;
}
