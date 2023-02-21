const dz = document.getElementById('droppable-zone');
dz.addEventListener('dragover', (event) => {
    event.preventDefault();
});
dz.addEventListener('drop', (event) => {
    event.preventDefault();
    generateHash(event.dataTransfer.files[0]);
});
function generateHash(c) {
  const reader = new FileReader();
  reader.onload = function (event) {
    const cData = event.target.result;
    const wordArray = CryptoJS.lib.WordArray.create(cData);
    const h = CryptoJS.SHA512(wordArray).toString();
    document.getElementById("output").value = h;
  };
  reader.readAsArrayBuffer(c);
}