const input = document.querySelector("#phone");

window.intlTelInput(input, {
  initialCountry: "CM", // Pays initial Cameroun
  separateDialCode: true, // Garder le code de pays séparé
  onlyCountries: ['CM'], // Limiter à un seul pays (Cameroun)
  geoIpLookup: callback => {
    fetch("https://ipapi.co/json")
      .then(res => res.json())
      .then(data => callback(data.country_code))
      .catch(() => callback("CM")); // Utilise "CM" comme valeur par défaut
  },
  utilsScript: "/intl-tel-input/js/utils.js?1714642302458", // Pour la mise en forme des numéros
  dropdownContainer: document.body, // Empêche le menu déroulant d'apparaître
  hiddenInput: "full_phone" // Optionnel : cacher le champ qui contient le numéro complet
});