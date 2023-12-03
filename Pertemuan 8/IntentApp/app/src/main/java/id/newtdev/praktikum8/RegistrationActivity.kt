package id.newtdev.praktikum8

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.TextView
import id.newtdev.praktikum8.databinding.ActivityRegistrationBinding

class RegistrationActivity : AppCompatActivity() {

    private lateinit var binding: ActivityRegistrationBinding
    private lateinit var tvName: TextView
    private lateinit var tvNim: TextView

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        var binding = ActivityRegistrationBinding.inflate(layoutInflater)
        setContentView(binding.root)

        val name = intent.getStringExtra("name")
        val nim = intent.getStringExtra("nim")


        // BINDING
        tvName = binding.tvName
        tvNim = binding.tvNim

        // SET DATA FROM EXTRA
        tvName.text = name
        tvNim.text = nim
    }
}