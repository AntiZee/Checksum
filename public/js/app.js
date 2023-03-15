let counter = 0;
function changeText() {
    const texts = ["Non-Academic Digital Certificate Verificator (SHA-512)", "Login to Save Your Certificate Data"];
    const head1 = document.getElementById("head1");
    head1.textContent = "Login to Save Your Certificate Data";
    setTimeout(function () {
        counter++;
        if (counter == texts.length) {
            counter = 0;
        }
        head1.textContent = texts[counter];
    });
}
setInterval(changeText, 2000);
function justhash() {
    const input = document.getElementById("input").files[0];
    const text = document.getElementById("droppable-zone-text");
    const output = document.getElementById("output");
    const validExtension = ["image/jpeg", "image/png", "application/pdf"];
    const validSignature = [
        { type: "image/jpeg", signature: [0xFF, 0xD8, 0xFF] },
        { type: "image/png", signature: [0x89, 0x50, 0x4E, 0x47, 0x0D, 0x0A, 0x1A, 0x0A] },
        { type: "application/pdf", signature: [0x25, 0x50, 0x44, 0x46] }
    ];
    const maxSize = 5 * 1024 * 1024;
    if (input.size > maxSize) {
        alert("The selected certificate exceeds the maximum file size of 5 MB.");
        clearInput();
        return;
    } else if (!validExtension.includes(input.type)) {
        alert("Invalid certificate format. Please select a JPEG, PNG, or PDF extension.");
        clearInput();
        return;
    } else {
        const r = new FileReader();
        r.onload = function (e) {
            const fileSignature = new Uint8Array(e.target.result).slice(0, 8);
            const validType = validSignature.find((item) => {
                for (let i = 0; i < item.signature.length; i++) {
                    if (item.signature[i] !== fileSignature[i]) {
                        return false;
                    }
                }
                return true;
            });
            if (!validType) {
                alert("Invalid certificate format. Please select a JPEG, PNG, or PDF file.");
                clearInput();
                return;
            } else {
                const wordArray = CryptoJS.lib.WordArray.create(e.target.result);
                const hash = CryptoJS.SHA512(wordArray);
                output.value = hash;
                text.innerText = input.name;
            }
        };
        r.readAsArrayBuffer(input);
    }
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
    const validExtension = ["image/jpeg", "image/png", "application/pdf"];
    const validSignature = [
        { type: "image/jpeg", signature: [0xFF, 0xD8, 0xFF] },
        { type: "image/png", signature: [0x89, 0x50, 0x4E, 0x47, 0x0D, 0x0A, 0x1A, 0x0A] },
        { type: "application/pdf", signature: [0x25, 0x50, 0x44, 0x46] }
    ];
    const maxSize = 5 * 1024 * 1024;
    if (!validExtension.includes(input.type)) {
        alert("Invalid certificate format. Please select a JPEG, PNG, or PDF extension.");
        clearInput();
        return;
    } else if (input.size > maxSize) {
        alert("The selected file exceeds the maximum file size of 5 MB.");
        clearInput();
        return;
    } else {
        if (data.files && input) {
            certificate.files = data.files;
            const r = new FileReader();
            r.onload = function (e) {
                const fileSignature = new Uint8Array(e.target.result).slice(0, 8);
                const validType = validSignature.find((item) => {
                    for (let i = 0; i < item.signature.length; i++) {
                        if (item.signature[i] !== fileSignature[i]) {
                            return false;
                        }
                    }
                    return true;
                });
                if (!validType) {
                    alert("Invalid certificate format. Please select a JPEG, PNG, or PDF file.");
                    clearInput();
                    return;
                } else {
                    const wordArray = CryptoJS.lib.WordArray.create(e.target.result);
                    const hash = CryptoJS.SHA512(wordArray);
                    output.value = hash;
                    text.innerText = input.name;
                    namefile.value = input.name;
                    checksum.value = hash;
                    save.removeAttribute("disabled");
                }
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
            url: "search",
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