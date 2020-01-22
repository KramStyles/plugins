
function copyText() {
    var copyText = document.getElementById("numbers");
    copyText.select();
    document.execCommand("copy");
    alert("Numbers have been copied: ");
}
