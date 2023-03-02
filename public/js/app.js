function hash() {
    const input = document.getElementById("input").files[0];
    const text = document.getElementById("droppable-zone-text");
    const output = document.getElementById("output");
    const namefile = document.getElementById("namefile");
    const checksum = document.getElementById("hash");
    const save = document.getElementById("save");
    const validExt = ["image/jpeg", "image/png", "application/pdf"];
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
        namefile.value = input.name;
        checksum.value = hash;
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
$(document).ready(function () {
    $('#search').on('input', function () {
        const query = $(this).val();
        $.ajax({
            url: "search",
            type: "GET",
            data: { 'search': query },
            success: function (data) {
                $('#search_list').html(data);
            }
        });
    });
});