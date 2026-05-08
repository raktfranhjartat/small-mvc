document.addEventListener("DOMContentLoaded", () => {
  const gallery = document.getElementById("image-gallery");
  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightbox-img");
  const lightboxClose = document.getElementById("lightbox-close");

  if (!gallery) return;

  gallery.addEventListener("click", e => {
    if (e.target.tagName === "IMG") {
      lightboxImg.src = e.target.src;
      lightbox.style.display = "flex";
      lightbox.classList.add("show");
    }
  });

  lightboxClose.addEventListener("click", () => {
    lightbox.style.display = "none";
    ightbox.classList.remove("show");
    lightboxImg.src = "";
  });

  // Stäng om man klickar utanför bilden
  lightbox.addEventListener("click", e => {
    if (e.target === lightbox) {
      lightbox.style.display = "none";
      lightbox.classList.remove("show");
      lightboxImg.src = "";
    }
  });
});