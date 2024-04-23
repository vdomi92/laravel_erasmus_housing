<x-app-layout>
    <div class="card w-50 full-width-md mx-auto mt-1 p-2">
        <div class="text-center">
            <h2 class="fw-bold">Create new house listing</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('housings.store') }}" method="POST">
                @csrf

                <div class="mt-4">
                    <label for="country" class="form-label">Country</label>
                    <select id="country" class="form-select" name="country" aria-label="country select input">
                        <option selected>Select country</option>
                    </select>
                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
<script>
    let selectedCountry = "";

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

    (async () => {
        const countries = await fetchCountries();
        populateSelect(countries);
    })();

    document.querySelector('#country').addEventListener('change', (event) => {
        selectedCountry = event.target.value;
    });
</script>
