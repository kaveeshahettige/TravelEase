document.addEventListener("DOMContentLoaded", function() {
    const fileInputs = document.querySelectorAll('input[type="file"]');

    fileInputs.forEach(function(input) {
        input.addEventListener("change", function() {
            const fileName = this.value.split("\\").pop();
            const fileUploadContainer = this.closest(".custom-file-upload");
            const fileDisplayName = fileUploadContainer.querySelector(".file-name");
            fileDisplayName.innerText = fileName !== "" ? fileName : "No file chosen";
        });
    });
});
