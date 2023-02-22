function hash() {
    const input = document.getElementById("input").files[0];
    const text = document.getElementById("droppable-zone-text");
    const output = document.getElementById("output");
    const validExt = ["image/jpeg", "image/png", "application/pdf"];
    if (!validExt.includes(input.type)) {
        alert("Invalid certificate format. Please select a JPEG, PNG, or PDF extension.");
        clearInput();
        return;
    }
    const r = new FileReader();
    r.onload = function (e) {
        const wordArray = CryptoJS.lib.WordArray.create(e.target.result);
        const h = CryptoJS.SHA512(wordArray);
        output.value = h;
        text.innerText = input.name;
    };
    r.readAsArrayBuffer(input);
}
function clearInput() {
    document.getElementById("input").value = "";
    document.getElementById("droppable-zone-text").innerText = "Drag & drop your certificate here OR click to browse";
    document.getElementById("output").value = "";
}