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
    /// MULTI CHECK
    private fun multiCheck(value: Map<String, EditText>): Boolean {
        var isValid  = false
        value.map { isValid = it.value.text.isEmpty() || (it.value.text.isBlank()) }
        return isValid
    }
    // MULTI ERROR SHOW
    private fun multiError(value: Map<String, EditText>) {
        value.map {
            if(it.value.text.isEmpty()) {
                it.value.error = "${it.key} harus diisi"
            }
        }
    }
    @SuppressLint("SetTextI18n")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        // INIT VAR BINDING
        val LebarTxt : EditText = findViewById(R.id.et_width)
        val PanjangTxt : EditText = findViewById(R.id.et_length)
        val TinggiTxt : EditText = findViewById(R.id.et_height)
        val calculateBtn : Button = findViewById(R.id.btn_calculate)
        val luasBtn : Button = findViewById(R.id.btn_calculate_luas)
        val kelBtn : Button = findViewById(R.id.btn_calculate_keliling)
        val resultView : TextView = findViewById(R.id.tv_result)
        val formData : Map<String, EditText> = mapOf(
            "Lebar" to LebarTxt,
            "Panjang" to PanjangTxt,
            "Tinggi" to TinggiTxt
        )
        // CHECK FORM VALIDATION
        fun checkFormValidation(form: Map<String, EditText>, callback: (MutableMap<String, Double>) -> Unit) {
            multiError(form)
            if(!multiCheck(form)){
                var data = mutableMapOf<String, Double>()
                form.map { data.put(it.key, it.value.text.toString().toDouble()) }
                callback(data)
                Toast.makeText(this, "Berhasil menghitung", Toast.LENGTH_SHORT).show()
            }
        }
        // CALCULATE FUNCTION
        calculateBtn.setOnClickListener {
            checkFormValidation(formData) {
                val volumeCount = it.getValue("Lebar") * it.getValue("Panjang") * it.getValue("Tinggi")
                resultView.text = "Volume: $volumeCount m3"
            }
        }
        luasBtn.setOnClickListener {
            checkFormValidation(formData) {
                val luasCount = 2 * ((it.getValue("Panjang")*it.getValue("Lebar")) + (it.getValue("Panjang")*it.getValue("Tinggi")) + (it.getValue("Lebar")*it.getValue("Tinggi")))
                resultView.text = "Luas: $luasCount m2"
            }
        }
        kelBtn.setOnClickListener {
            checkFormValidation(formData) {
                val kelCount = 4 *(it.getValue("Lebar") + it.getValue("Panjang") * it.getValue("Tinggi"))
                resultView.text = "Keliling: $kelCount m"
            }
        }
    }
}