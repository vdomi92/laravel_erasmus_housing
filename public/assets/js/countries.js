const fetchCountries = async () => {
    const cachedCountries = localStorage.getItem('countries');

    if(cachedCountries) {
        return JSON.parse(cachedCountries);
    }

    try{
        const response = await fetch('https://restcountries.com/v3.1/all');
        const data = await response.json();
        const countryNames = data.map(country => country.name.common).sort();
        localStorage.setItem('countries', JSON.stringify(countryNames));
        return countryNames;
    }catch(error){
        console.error("Error fetching country names:", error);
        return [];
    }

}

const populateSelect = (countryNamesArray) => {
    const select = document.querySelector('#country');
    countryNamesArray.forEach(country => {
        const option = document.createElement('option');
        option.value = country;
        option.textContent = country;
        select.appendChild(option);
    });
}

let selectedCountry = "";

(async () => {
    const countries = await fetchCountries();
    populateSelect(countries);
})();

document.querySelector('#country').addEventListener('change', (event) => {
    selectedCountry = event.target.value;
});
