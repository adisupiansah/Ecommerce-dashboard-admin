// function sendWhatsApp(){
//     var nama = document.getElementById('Name').value;
//     var nomor = document.getElementById('Number').value;
//     var komentar = document.getElementById('Comment').value;

//     var nomorWhatsApp = "6281275669055";

//     var url = "https://api.whatsapp.com/send?phone=" + nomorWhatsApp + "&text=Name: " + nama + "%0A%0A" + "Phone Number: " + nomor + "%0A%0A" + "Message: " + komentar;

//     window.open(url, "_blank");

// }


// LINK ACTIVE
const linkcolor = document.querySelectorAll('.nav-link');
function colorLink() {
    linkcolor.forEach(l => l.classList.remove('active'));
    this.classList.add('active');
    
}
linkcolor.forEach(l=> l.addEventListener('click', colorLink))
