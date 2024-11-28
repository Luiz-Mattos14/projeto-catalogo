import { formatMoneyInput } from "../common/utilities.js";

const Product = {
  setImageForm: function () {
    const imageForms = document.querySelectorAll("[data-image-form]");

    if (imageForms.length > 0)
      imageForms.forEach((image) => {
        const imageInput = image.querySelector("input");

        imageInput.addEventListener("change", (event) => {
          const file = event.target.files[0];

          if (file) {
            const reader = new FileReader();

            // Quando a imagem for carregada pelo FileReader
            reader.onload = function (e) {
              const previewContainer = image.querySelector(
                ".image-preview-container"
              );
              const previewImage = image.querySelector(".image-preview");

              // Define a fonte da imagem para a prévia
              previewImage.src = e.target.result;

              // Exibe o container com a imagem
              previewContainer.style.display = "block";
            };

            // Lê o arquivo como uma URL de dados
            reader.readAsDataURL(file);
          }
        });
      });
  },

  init: function () {
    console.log("Entrou no JAVASCRIPT PRODUCT");

    this.setImageForm();
    formatMoneyInput();
  },
};

export default Product;
