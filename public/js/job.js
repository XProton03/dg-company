function addSkill(jobId) {
    const skillsContainer = document.getElementById(
        `skills-container-${jobId}`
    );
    const skillInput = document.createElement("div");
    skillInput.classList.add("input-group", "mt-1");
    skillInput.innerHTML = `
        <input type="text" class="form-control" name="skill[]" placeholder="Masukan skill yang dikuasai">
        <button type="button" class="btn btn-danger" onclick="removeSkill(this)">Hapus</button>`;
    skillsContainer.appendChild(skillInput);
}

function removeSkill(button) {
    button.parentElement.remove();
}

function validatePhoneNumber(input, errorId) {
    const phoneNumber = input.value;
    const errorElement = document.getElementById(errorId);

    // Reset error
    errorElement.textContent = "";

    if (phoneNumber.length > 15) {
        errorElement.textContent =
            "Nomor telepon tidak boleh lebih dari 15 angka.";
        input.value = phoneNumber.slice(0, 15); // Potong hingga 15 angka
        return;
    }

    if (phoneNumber.startsWith("0")) {
        errorElement.textContent =
            "Nomor telepon tidak boleh diawali dengan angka 0.";
        input.value = ""; // Reset input jika diawali dengan 0
        return;
    }

    if (!/^[1-9]\d*$/.test(phoneNumber)) {
        errorElement.textContent =
            "Nomor telepon hanya boleh berisi angka dan tidak boleh diawali dengan 0.";
        input.value = ""; // Reset input jika tidak sesuai format
        return;
    }
}

function validateFile(input, type, errorId) {
    const errorElement = document.getElementById(errorId);
    const file = input.files[0];
    const maxSize = 2 * 1024 * 1024; // 2MB
    const validImageTypes = ["image/jpeg", "image/png"];
    const validPdfTypes = ["application/pdf"];

    // Reset error
    errorElement.textContent = "";

    if (
        type === "image" &&
        (!file || file.size > maxSize || !validImageTypes.includes(file.type))
    ) {
        errorElement.textContent =
            "Hanya file gambar (JPG, PNG) maksimal 2MB yang diperbolehkan.";
        input.value = "";
        return;
    }

    if (
        type === "cv_file" &&
        (!file || file.size > maxSize || !validPdfTypes.includes(file.type))
    ) {
        errorElement.textContent =
            "Hanya file PDF maksimal 2MB yang diperbolehkan.";
        input.value = "";
        return;
    }
}
document.querySelectorAll(".modal").forEach((modal) => {
    modal.addEventListener("hidden.bs.modal", function () {
        // Reset form di dalam modal ini
        const form = this.querySelector("form");
        if (form) form.reset();

        // Bersihkan elemen error
        this.querySelectorAll(".text-danger").forEach(
            (error) => (error.textContent = "")
        );
    });
});
let inactivityTimeout;

// Waktu tidak aktif (dalam milidetik)
const inactivityTime = 300000; // 5 menit

// Fungsi untuk melakukan refresh
function refreshPage() {
    location.reload(); // Refresh halaman
}

// Reset timer aktivitas
function resetTimer() {
    clearTimeout(inactivityTimeout); // Bersihkan timer sebelumnya
    inactivityTimeout = setTimeout(refreshPage, inactivityTime); // Set timer baru
}

// Tambahkan event listener untuk mendeteksi aktivitas
window.onload = resetTimer; // Saat halaman dimuat
document.onmousemove = resetTimer; // Gerakan mouse
document.onkeypress = resetTimer; // Penekanan keyboard
document.onscroll = resetTimer; // Scroll halaman
document.ontouchstart = resetTimer; // Sentuhan (untuk perangkat layar sentuh)
