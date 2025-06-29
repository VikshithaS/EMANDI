const sectionIngredient = document.getElementById("section-ingredient");
const sectionSupplier = document.getElementById("section-supplier");
const sectionAllergy = document.getElementById("section-allergy");

const navToIngredient = document.getElementById("nav-ingredient");
const navToSupplier = document.getElementById("nav-supplier");
const navToAllergy = document.getElementById("nav-allergy");

const nextToSupplier = document.getElementById("next-supplier");
const nextToAllergy = document.getElementById("next-allergy");

defaultLinkClass =
  "px-6 py-2 rounded-lg text-gray-700 hover:text-gray-500 focus:outline-none";
activeLinkClass =
  "px-6 py-2 rounded-lg bg-white mr-2 hover:text-gray-500 focus:outline-none";

navToIngredient.addEventListener("click", () => {
  navigateToSection(navToIngredient);
});

navToSupplier.addEventListener("click", () => {
  navigateToSection(navToSupplier);
});

navToAllergy.addEventListener("click", () => {
  navigateToSection(navToAllergy);
});

nextToSupplier.addEventListener("click", () => {
  navigateToSection(navToSupplier);
});

nextToAllergy.addEventListener("click", () => {
  navigateToSection(navToAllergy);
});

function navigateToSection(navLinkClicked) {
  if (navLinkClicked === navToIngredient) {
    sectionIngredient.classList.remove("hidden");
    sectionSupplier.classList.add("hidden");
    sectionAllergy.classList.add("hidden");

    navToIngredient.className = activeLinkClass;
    navToSupplier.className = defaultLinkClass;
    navToAllergy.className = defaultLinkClass;
  } else if (navLinkClicked === navToSupplier) {
    sectionSupplier.classList.remove("hidden");
    sectionIngredient.classList.add("hidden");
    sectionAllergy.classList.add("hidden");

    navToSupplier.className = activeLinkClass;
    navToIngredient.className = defaultLinkClass;
    navToAllergy.className = defaultLinkClass;
  } else {
    sectionAllergy.classList.remove("hidden");
    sectionIngredient.classList.add("hidden");
    sectionSupplier.classList.add("hidden");

    navToAllergy.className = activeLinkClass;
    navToIngredient.className = defaultLinkClass;
    navToSupplier.className = defaultLinkClass;
  }
}
