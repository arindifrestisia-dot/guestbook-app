// import './bootstrap';
import Swal from "sweetalert2";
import Alpine from "alpinejs";

document.addEventListener("DOMContentLoaded", function () {
    var greetingElement = document.getElementById("greeting");
    if (greetingElement) {
        var currentHour = new Date().getHours();

        if (currentHour < 11) {
            greetingElement.textContent = "Selamat Pagi !";
        } else if (currentHour < 18) {
            greetingElement.textContent = "Selamat Siang !";
        } else {
            greetingElement.textContent = "Selamat Malam !";
        }

        greetingElement.removeAttribute("hidden");
    }
});

//Tombol Kembali
document.getElementById("back-button").addEventListener("click", function () {
    window.history.back();
});

Swal.fire({
    icon: "error",
    title: "Gagal!",
    html: "{!! implode(" < br > ", $errors->all()) !!}",
});

window.Alpine = Alpine;

Alpine.start();

function confirmEdit() {
    Swal.fire({
        title: "Yakin ingin mengubah data?",
        text: "Pastikan data yang diubah sudah benar.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, ubah!",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("editForm").submit();
        }
    });

    document.querySelectorAll(".pakaiButton").forEach(function (button) {
        button.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent default form submission
            this.textContent = "Dipakai";
            this.classList.remove(
                "bg-gradient-to-tr",
                "from-cyan-600",
                "to-cyan-400",
                "text-white",
                "shadow-md",
                "shadow-cyan-500/20",
                "hover:shadow-lg",
                "hover:shadow-cyan-500/40",
                "active:opacity-[0.85]"
            );
            this.classList.add("bg-white", "text-gray-900");
            // Add your custom logic here if necessary
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const biayaDpdInput = document.getElementById("biaya_dpd");

        biayaDpdInput.addEventListener("input", function (event) {
            let value = event.target.value.replace(/[^,\d]/g, "").toString();
            if (value) {
                const parts = value.split(",");
                const remainder = parts[0].length % 3;
                let rupiah = parts[0].substr(0, remainder);
                const thousands = parts[0].substr(remainder).match(/\d{3}/g);

                if (thousands) {
                    const separator = remainder ? "." : "";
                    rupiah += separator + thousands.join(".");
                }

                event.target.value =
                    "Rp. " +
                    (parts[1] !== undefined ? rupiah + "," + parts[1] : rupiah);
            } else {
                event.target.value = "";
            }
        });
    });
}
