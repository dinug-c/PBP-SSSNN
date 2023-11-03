package id.newtdev.pbp7

import android.annotation.SuppressLint
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.os.PersistableBundle
import android.view.View
import android.widget.Button
import android.widget.EditText
import android.widget.TextView
import android.widget.Toast

class MainActivity : AppCompatActivity() {

    // VALIDITY FUNCTION
    // CHECK LIST OF EDITTEXT
    private fun checkValidity(value: List<EditText>): Boolean {
        var isValid  = false
        for (editText in value){
            if(editText.text.isEmpty()) isValid = true
        }
        return isValid
    }
    // SINGLE CHECK
    private fun checkSingleValidity(value: EditText): Boolean {
        return value.text.isEmpty();
    }

    @SuppressLint("SetTextI18n")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        // INIT VAR BINDING
        val lebarTxt : EditText = findViewById(R.id.et_width)
        val panjangTxt : EditText = findViewById(R.id.et_length)
        val tinggiTxt : EditText = findViewById(R.id.et_height)
        val calculateBtn : Button = findViewById(R.id.btn_calculate)
        val luasBtn : Button = findViewById(R.id.btn_calculate_luas)
        val kelBtn : Button = findViewById(R.id.btn_calculate_keliling)
        val resultView : TextView = findViewById(R.id.tv_result)

        // CHECK FORM VALIDATION
        fun checkFormValidation(callback: (Map<String, Double>) -> Unit) {
            if(checkSingleValidity(lebarTxt)){
                lebarTxt.error = "Lebar wajib diisi"
            }
            if(checkSingleValidity(panjangTxt)){
                panjangTxt.error = "Panjang wajib diisi"
            }
            if(checkSingleValidity(tinggiTxt)){
                tinggiTxt.error = "Tinggi wajib diisi"
            }
            if(!checkValidity(listOf(lebarTxt, panjangTxt, tinggiTxt))){
                val lebarValue = lebarTxt.text.toString().toDouble()
                val panjangValue = panjangTxt.text.toString().toDouble()
                val tinggiValue = tinggiTxt.text.toString().toDouble()
                val mapCallback = mapOf("lebar" to lebarValue, "panjang" to panjangValue, "tinggi" to tinggiValue )
                callback(mapCallback)
                Toast.makeText(this, "Berhasil menghitung", Toast.LENGTH_SHORT).show()
            }
        }

        // CALCULATE FUNCTION
        calculateBtn.setOnClickListener {
            checkFormValidation {
                val volumeCount = it.getValue("lebar") * it.getValue("panjang") * it.getValue("tinggi")
                resultView.text = "Volume: $volumeCount m3"
            }
        }

        luasBtn.setOnClickListener {
            checkFormValidation {
                val luasCount = 2 * ((it.getValue("panjang")*it.getValue("lebar")) + (it.getValue("panjang")*it.getValue("tinggi")) + (it.getValue("lebar")*it.getValue("tinggi")))
                resultView.text = "Luas: $luasCount m2"
            }
        }

        kelBtn.setOnClickListener {
            checkFormValidation {
                val kelCount = 4 *(it.getValue("lebar") + it.getValue("panjang") * it.getValue("tinggi"))
                resultView.text = "Keliling: $kelCount m"
            }
        }
    }
}