const termsAnchor = document.querySelector(".terms > p > a")
const termsDetails = document.querySelector(".terms-details")
const termsDetailsAnchor = document.querySelector(".terms-details > small > a")

termsAnchor.addEventListener("click", () => {
    if (!termsDetails.classList.contains("terms-active"))
        termsDetails.classList.add("terms-active")
})

termsDetailsAnchor.addEventListener("click", () => {
    if (termsDetails.classList.contains("terms-active"))
        termsDetails.classList.remove("terms-active")
})

setTimeout(() => {
    termsDetails.style.display = "block";
}, 999)
