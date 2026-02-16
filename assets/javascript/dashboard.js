function toggleAdminMenu() {
    const dropdown = document.getElementById("adminDropdown");
    if (!dropdown) return;

    dropdown.style.display = 
        dropdown.style.display === "block" ? "none" : "block";
}

document.addEventListener("click", function (e) {
    const menu = document.querySelector(".admin-menu");
    const dropdown = document.getElementById("adminDropdown");

    if (!menu || !dropdown) return;

    if (!menu.contains(e.target)) {
        dropdown.style.display = "none";
    }
});
