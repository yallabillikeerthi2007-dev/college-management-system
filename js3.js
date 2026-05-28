 function openCourses() {
    document.getElementById("coursesDrawer").classList.add("open");
    document.getElementById("overlay").classList.add("show");
}
function closeCourses(){
    document.getElementById("coursesDrawer").classList.remove("open");
    document.getElementById("overlay").classList.remove("show");
}
function openhelp() {
    document.getElementById("helpDrawer").classList.add("open");
    document.getElementById("overlay").classList.add("show");
}

function closehelp() {
    document.getElementById("helpDrawer").classList.remove("open");
    document.getElementById("overlay").classList.remove("show");
}
let startY = 0;
        document.getElementById('coursesDrawer').addEventListener('touchstart', e => {
            startY = e.touches[0].clientY;
        });
        document.getElementById('coursesDrawer').addEventListener('touchend', e => {
            if (e.changedTouches[0].clientY - startY > 80) {
                closeCourses();
            }
        });
