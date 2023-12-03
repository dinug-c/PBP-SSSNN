package id.newtdev.praktikum8

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import id.newtdev.praktikum8.databinding.ActivityMainBinding

class MainActivity : AppCompatActivity() {

    private lateinit var binding: ActivityMainBinding
    private lateinit var mulaiBtn: Button
    private lateinit var withDataBtn: Button

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        var binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)

        // BINDING
        mulaiBtn = binding.btnStart
        withDataBtn = binding.btnWithData

        // INTENT VAR DECLARE
        val intent = Intent(this, RegistrationActivity::class.java)

        // BUTTON FUNCTION
        // MOVE WITHOUT DATA
        mulaiBtn.setOnClickListener {
            startActivity(intent)
        }
        // MOVE WITH DATA
        withDataBtn.setOnClickListener {
            intent.putExtra("name", "Resma Adi Nugroho")
            intent.putExtra("nim", "24060121120021")
            startActivity(intent)
        }

    }
}