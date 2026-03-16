// ADMIN DROPDOWN
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
// CLOCK
function updateClock() {
    const now = new Date();
    const optionsDate = {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric"
    };
    const date = now.toLocaleDateString("en-US", optionsDate);
    const time = now.toLocaleTimeString("en-US", {
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit"
    });
    const clock = document.getElementById("currentTimeSmall");
    if (clock) {
        clock.innerHTML = date + "<br>" + time;
    }
}
setInterval(updateClock, 1000);
updateClock();
// DISABLE BACK BUTTON AFTER LOGIN
history.pushState(null, null, location.href);
window.onpopstate = function () {
    history.go(1);
};
// CALENDAR
let currentDate = new Date();
function renderCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    const today = new Date();
    const monthNames = [
        "January","February","March","April","May","June",
        "July","August","September","October","November","December"
    ];
    const monthTitle = document.getElementById("monthTitle");
    if (monthTitle) {
        monthTitle.innerText = monthNames[month] + " " + year;
    }
    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    let table = "";
    let day = 1;
    for (let i = 0; i < 6; i++) {
        table += "<tr>";
        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay) {
                table += "<td></td>";
            }
            else if (day > daysInMonth) {
                table += "<td></td>";
            }
            else {
                if (
                    day === today.getDate() &&
                    month === today.getMonth() &&
                    year === today.getFullYear()
                ) {
                    table += "<td><span class='today-date'>" + day + "</span></td>";
                }
                else {
                    table += "<td>" + day + "</td>";
                }
                day++;
            }
        }
        table += "</tr>";
    }
    const calendarBody = document.getElementById("calendarBody");
    if (calendarBody) {
        calendarBody.innerHTML = table;
    }
}

function changeMonth(step) {
    currentDate.setMonth(currentDate.getMonth() + step);
    renderCalendar();
}

function goToday() {
    currentDate = new Date();
    renderCalendar();
}

document.addEventListener("DOMContentLoaded", function () {
    renderCalendar();
});