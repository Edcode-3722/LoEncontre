import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

if (document.querySelector("#dropzone")) {
    const dropzone = new Dropzone("#dropzone", {
        dictDefaultMessage: "Sube aquí tu imagen",
        acceptedFiles: ".png, .jpg, .jpeg, .gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar archivo",
        maxFiles: 1,
        uploadMultiple: false,

        init: function () {
            const nombreImagen =
                document.querySelector('[name="imagen"]').value;
            if (nombreImagen.trim()) {
                const imagenPublicada = {};
                imagenPublicada.size = 1234;
                imagenPublicada.name = nombreImagen;

                this.options.addedfile.call(this, imagenPublicada);
                this.options.thumbnail.call(
                    this,
                    imagenPublicada,
                    `/uploads/${imagenPublicada.name}`
                );

                imagenPublicada.previewElement.classList.add(
                    "dz-success",
                    "dz-complete"
                );
            }
        },
    });

    dropzone.on("success", function (file, response) {
        document.querySelector('[name="imagen"]').value = response.imagen;
    });

    dropzone.on("removedfile", function () {
        console.log("Archivo eliminado...");
    });

    dropzone.on("removedfile", function () {
        document.querySelector("input[name='imagen']").value = "";
    });
}
