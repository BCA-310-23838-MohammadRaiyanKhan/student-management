/* ================== DARK MODE ================== */
function toggleDarkMode() {
    document.body.classList.toggle("dark");
    localStorage.setItem(
        "theme",
        document.body.classList.contains("dark") ? "dark" : "light"
    );
}

document.addEventListener("DOMContentLoaded", () => {

    /* Load saved theme */
    if (localStorage.getItem("theme") === "dark") {
        document.body.classList.add("dark");
    }

    /* Auto hide alerts */
    document.querySelectorAll(".auto-hide").forEach(el => {
        setTimeout(() => el.style.display = "none", 3000);
    });

    /* Animate cards on scroll */
    const cards = document.querySelectorAll(".dashboard-card");
    cards.forEach(card => {
        card.addEventListener("mouseenter", () => {
            card.style.transform = "scale(1.05)";
        });
        card.addEventListener("mouseleave", () => {
            card.style.transform = "scale(1)";
        });
    });

});

/* ================== CONFIRM LOGOUT ================== */
function confirmLogout() {
    if (confirm("Are you sure you want to logout?")) {
        window.location.href = "../logout.php";
    }
}
document.getElementById("searchInput")
.addEventListener("keyup", function() {
    let value = this.value.toLowerCase();
    document.querySelectorAll("table tbody tr")
    .forEach(row => {
        row.style.display = row.innerText
        .toLowerCase().includes(value) ? "" : "none";
    });
});
