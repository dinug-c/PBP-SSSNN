package id.newtdev.praktikum9

import android.content.Intent
import android.net.Uri
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import android.widget.EditText
import id.newtdev.praktikum9.databinding.ActivityCallBinding

class CallActivity : AppCompatActivity() {

    private lateinit var binding: ActivityCallBinding
    private lateinit var etPhone: EditText
    private lateinit var btnCall: Button

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityCallBinding.inflate(layoutInflater)
        setContentView(binding.root)
        // BINDING
        etPhone = binding.etPhone
        btnCall = binding.btnCall

        // CALL FUNC
        fun call() {
            val phone = etPhone.text.toString()
            if(phone.isEmpty()){
                etPhone.error = "Nomor Telepon Tidak Boleh Kosong"
                return
            }
            val intent = Intent(Intent.ACTION_DIAL, Uri.parse("tel:$phone"))
            startActivity(intent)
        }

        btnCall.setOnClickListener { call() }
    }
}