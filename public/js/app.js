function hash() {
    const c = document.getElementById("input").files[0];
    const t = document.getElementById("droppable-zone-text");
    const r = new FileReader();
    r.onprogress = function (e0) {
        if (e0.lengthComputable) {
            percentComplete = (e0.loaded / e0.total * 100).toFixed(0);
            t.innerText = `Hashing... ${percentComplete}%`;
        } else {
            percentComplete = 0;
        }
    };
    r.onload = function (e1) {
        const wordArray = CryptoJS.lib.WordArray.create(e1.target.result);
        const h = CryptoJS.SHA512(wordArray);
        document.getElementById("output").value = h;
        t.innerText = c.name;
    };
    r.readAsArrayBuffer(c);
}
function clearInput() {
    document.getElementById("input").value = "";
    document.getElementById("output").value = "";
    document.getElementById("droppable-zone-text").innerText = "Drag & drop your certificate here OR click to browse";
}