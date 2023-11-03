function validateForm() {
    //validasi name tidak boleh kosong
    if (document.forms["formRegistration"]["name"].value == "") {
        alert("Please fill your name.");
        document.forms["formRegistration"]["name"].focus();
        return false;
    }
    //validasi gender tidak boleh kosong
    if (document.forms["formRegistration"]["gender"].value == "") {
        alert("Please select your gender.");
        return false;
    }
    //validasi height tidak boleh bernilai 0
    if (document.forms["formRegistration"]["height"].value == 0) {
        alert("Please fill your height.");
        document.forms["formRegistration"]["height"].focus();
        return false;
    }

    //validasi height harus numerik
    if (Number.isNaN(document.forms["formRegistration"]["height"].value)) {
        alert("Height must be numeric");
        document.forms["formRegistration"]["height"].value = "";
        document.forms["formRegistration"]["height"].focus();
        return false;
    }

    //validasi alamat tidak boleh kosong
    if (document.forms["formRegistration"]["address"].value == "") {
        alert("Please fill your address.");
        document.forms["formRegistration"]["address"].focus();
        return false;
    }
    //validasi kota tidak boleh kosong
    if (document.forms["formRegistration"]["city"].value == "") {
        alert("Please select your city.");
        document.forms["formRegistration"]["city"].focus();
        return false;
    }
    //validasi hobby, minimal pilih salah satu
    var hobby = document.forms["formRegistration"]["hobby"];
    if (hobby[0].checked == false && hobby[1].checked == false && hobby[2].checked == false && hobby[3].checked == false) {
        alert("Please select at least one hobby.");
        return false;
    }
    //validasi text captcha harus sesuai dengan captcha yang di-generate
    if (document.forms["formRegistration"]["captcha_input"].value != document.forms["formRegistration"]["captcha_text"].value) {
        alert("Please type Captcha correctly.");
    }
    alert('Success! Thank you for filling the form.')
    return true;
}

//fungsi untuk mengisi elemen dropdown city sesuai nilai province yang dipilih
function get_city() {
    let province = document.forms["formRegistration"]["province"].value;
    if (province == "West Java") {
        document.getElementById("city").innerHTML =
            '<option value="Bandung">Bandung</option>' +
            '<option value="Kuningan">Kuningan</option>' +
            '<option value="Indramayu">Indramayu</option>';
    }
    if (province == "Central Java") {
        document.getElementById("city").innerHTML =
            '<option value="Semarang">Semarang</option>' +
            '<option value="Ungaran">Ungaran</option>' +
            '<option value="Solo">Solo</option>';
    }
    if (province == "East Java") {
        document.getElementById("city").innerHTML =
            '<option value="Surabaya">Surabaya</option>' +
            '<option value="Sidoarjo">Sidoarjo</option>' +
            '<option value="Malang">Malang</option>';
    }
}

//fungsi untuk genereta captcha
function generateCaptcha() {
    let a = Math.ceil(Math.random() * 9) + '';
    let b = Math.ceil(Math.random() * 9) + '';
    let c = Math.ceil(Math.random() * 9) + '';
    let d = Math.ceil(Math.random() * 9) + '';
    let e = Math.ceil(Math.random() * 9) + '';
    let code = a + b + c + d + e;
    document.forms["formRegistration"]["captcha_text"].value = code;
}