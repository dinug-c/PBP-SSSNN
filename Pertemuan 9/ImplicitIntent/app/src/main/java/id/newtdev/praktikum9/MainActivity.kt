package id.newtdev.praktikum9

import android.content.Intent
import android.content.pm.PackageManager
import android.net.Uri
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import android.widget.EditText
import androidx.appcompat.app.AlertDialog
import id.newtdev.praktikum9.databinding.ActivityMainBinding

class MainActivity : AppCompatActivity() {

    private lateinit var binding: ActivityMainBinding
    private lateinit var etTo: EditText
    private lateinit var etSubject: EditText
    private lateinit var etBody: EditText
    private lateinit var btnSend: Button
    private lateinit var btnCall: Button

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)
        // BINDING
        etTo = binding.etTo
        etSubject = binding.etSubject
        etBody =  binding.etBody
        btnSend = binding.btnSend
        btnCall = binding.btnCall

        // MAIL INTENT FUNC
        fun sendEmail() {
            val email = etTo.text.toString()
            val subject = etSubject.text.toString()
            val body = etBody.text.toString()

            val gmailPackage = "com.google.android.gm"
            val isGmailInstalled = isAppInstalled(gmailPackage)
            val intent = Intent(Intent.ACTION_SEND)
            intent.putExtra(Intent.EXTRA_EMAIL, arrayOf(email))
            intent.putExtra(Intent.EXTRA_SUBJECT, subject)
            intent.putExtra(Intent.EXTRA_TEXT, body)
            // CHECK IF GMAIL INSTALLED
            if (isGmailInstalled) {
                intent.type = "text/html"
                intent.setPackage(gmailPackage)
                startActivity(intent)
            } else {
                // IF ITS NOT THEN OPEN OTHER APP
                intent.type = "message/rfc822"
                startActivity(Intent.createChooser(intent, "Pilih Aplikasi Email"))
            }


        }

        fun showConfirm() {
            val builder: AlertDialog.Builder = AlertDialog.Builder(this)
            builder
                .setMessage("To: ${etTo.text} \nSubject: ${etSubject.text} \nMessage: ${etBody.text}")
                .setTitle("Lets Recheck!")
                .setPositiveButton("Send") { dialog, which ->
                    sendEmail()
                }
                .setNegativeButton("Cancel") { dialog, which ->
                    dialog.cancel()
                }
            val dialog: AlertDialog = builder.create()
            dialog.show()
        }

        // SUBMIT AND VALIDATION
        btnSend.setOnClickListener {
            if (etTo.text.isEmpty()) {
                etTo.error = "Email tidak boleh kosong"
                etTo.requestFocus()
            } else if (etSubject.text.isEmpty()) {
                etSubject.error = "Subject tidak boleh kosong"
                etSubject.requestFocus()
            } else if (etBody.text.isEmpty()) {
                etBody.error = "Body tidak boleh kosong"
                etBody.requestFocus()
            } else {
                showConfirm()
            }
        }

        // OTHERS BUTTON
        btnCall.setOnClickListener {
            val intent = Intent(this, CallActivity::class.java)
            startActivity(intent)
        }


    }
    private fun isAppInstalled(packageName: String): Boolean {
        return try {
            packageManager.getApplicationInfo(packageName, 0)
            true
        } catch (e: PackageManager.NameNotFoundException) {
            false
        }
    }

}