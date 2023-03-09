const texts = ["Non-Academic Digital Certificate Verificator (SHA-512)", "Login to Save Your Certificate Data"];
let counter = 0;
function changeText() {
    const head1 = document.getElementById("head1");
    head1.textContent = "Login to Save Your Certificate Data";
    setTimeout(function () {
        counter++;
        if (counter >= texts.length) {
            counter = 0;
        }
        head1.textContent = texts[counter];
    }, 1500);
}
setInterval(changeText, 1500);
function justhash() {
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
    };
    r.readAsArrayBuffer(input);
}
function hash() {
    const data = document.querySelector('.droppable-file');
    const input = document.getElementById("input").files[0];
    const text = document.getElementById("droppable-zone-text");
    const output = document.getElementById("output");
    const namefile = document.getElementById("namefile");
    const checksum = document.getElementById("hash");
    const certificate = document.querySelector('input[name="certificate"]');
    const save = document.getElementById("save");
    const validExt = ["image/jpeg", "image/png", "application/pdf"];
    if (!validExt.includes(input.type)) {
        alert("Invalid certificate format. Please select a JPEG, PNG, or PDF extension.");
        clearInput();
        return;
    } else {
        if (data.files && input) {
            certificate.files = data.files;
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
    }
}
function clearInput() {
    document.getElementById("input").value = "";
    document.getElementById("droppable-zone-text").innerText = "Drag & drop your certificate here OR click to browse";
    document.getElementById("output").value = "";
    document.querySelector('input[name="certificate"]').value = "";
    document.getElementById("save").setAttribute("disabled", "disabled");
}
$(document).ready(function () {
    $('#search').on('input', function () {
        const query = $(this).val();
        $.ajax({
            url: "/search",
            type: "GET",
            data: {
                'search': query
            },
            success: function (data) {
                $('#search_results').html('');
                $('#search_results').append(data);
            }
        });
    });
});