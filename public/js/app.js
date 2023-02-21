function hash() {
    const c = document.getElementById("input").files[0];
    const t = document.getElementById("droppable-zone-text");
    const r = new FileReader();
    r.onload = function (e) {
        const wordArray = CryptoJS.lib.WordArray.create(e.target.result);
        const h = CryptoJS.SHA512(wordArray);
        document.getElementById("output").value = h;
        t.innerText = c.name;
    };
    r.readAsArrayBuffer(c);
}