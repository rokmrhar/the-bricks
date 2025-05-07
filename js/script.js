function reloadPage() {
    location.href='igra.php';
}

function rezultati() {
    location.href='konec.php';
}

setTimeout(function() {
    document.getElementById('sestevek1').style.opacity = "1";}, 1250);
setTimeout(function() {
    document.getElementById('sestevek2').style.opacity = "1";}, 1250);
setTimeout(function() {
    document.getElementById('sestevek3').style.opacity = "1";}, 1250);

function animkocke1() {
    setTimeout("document.getElementById('anim1').style.display = 'none'; document.getElementById('kocke1').style.display = 'inline-block';",1200);
}
function animkocke2() {
    setTimeout("document.getElementById('anim2').style.display = 'none'; document.getElementById('kocke2').style.display = 'inline-block';",1200);
}
function animkocke3() {
    setTimeout("document.getElementById('anim3').style.display = 'none'; document.getElementById('kocke3').style.display = 'inline-block';",1200);
}
animkocke1();
animkocke2();
animkocke3();

const infoBtn = document.getElementById("info");
infoBtn.addEventListener("click", () => {
    Swal.fire({
        icon: "info",
		iconColor: "#ffd700",
		background: '#113263',
		color: 'white',
		confirmButtonColor: '#ffd700',
        title: "GAMBLING ROOM",
        heightAuto: true,
		allowOutsideClick: false,
		footer: '<a style="color: white" target="_blank" href="https://github.com/rokmrhar/gambling-room">OGLEJ SI "VEČ" O TEM PROJEKTU</a>',
    });
});
const navodilaBtn = document.getElementById("navodila");
navodilaBtn.addEventListener("click", () => {
    Swal.fire({
        icon: "info",
		iconColor: "#ffd700",
		background: '#113263',
		color: 'white',
		confirmButtonColor: '#ffd700',
        title: "NAVODILA",
        heightAuto: true,
		html: 'Vnesi <b> VSA 3 IMENA </b>, izberi želeno število kock in iger in pritisni gumb <b> IGRAJ </b> za začetek igre',

    });
});
