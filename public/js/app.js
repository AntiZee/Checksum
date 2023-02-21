function hash() {
    const c = document.getElementById("input").files[0];
    const reader = new FileReader();
    reader.onload = function (event) {
        const wordArray = CryptoJS.lib.WordArray.create(event.target.result);
        const h = CryptoJS.SHA512(wordArray).toString();
        document.getElementById("output").value = h;
    };
    reader.readAsArrayBuffer(c);
}