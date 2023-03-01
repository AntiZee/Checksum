function hash() {
    const input = document.getElementById("input").files[0];
    const text = document.getElementById("droppable-zone-text");
    const output = document.getElementById("output");
    const validExt = ["image/jpeg", "image/png", "application/pdf"];
    const save = document.getElementById("save");
    if (!validExt.includes(input.type)) {
        alert("Invalid certificate format. Please select a JPEG, PNG, or PDF extension.");
        clearInput();
        return;
    }
    const r = new FileReader();
    r.onload = function (e) {
        const wordArray = CryptoJS.lib.WordArray.create(e.target.result);
        const hash = CryptoJS.SHA512(wordArray);
        output.value = hash;
        text.innerText = input.name;
        save.removeAttribute("disabled");
    };
    r.readAsArrayBuffer(input);
}
function clearInput() {
    document.getElementById("input").value = "";
    document.getElementById("droppable-zone-text").innerText = "Drag & drop your certificate here OR click to browse";
    document.getElementById("output").value = "";
    document.getElementById("save").setAttribute("disabled", "disabled");
}
function save() {
    const text = document.getElementById("droppable-zone-text").innerText;
    const checksum = document.getElementById("output").value;
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const url = '/save';
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                window.location.href = '/';
            }
        }
    };
    xhr.open('POST', url);
    xhr.setRequestHeader('X-CSRF-TOKEN', token);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify({ name: text, sha512: checksum }));
}