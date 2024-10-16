// Function to fetch weather data from OpenWeatherMap API
async function fetchWeather(lat, lon) {
    const apiKey = '2d17480e1fe8ac83d2ff8c0f22e718b9'; // Replace with your OpenWeatherMap API key
    const apiUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`;

    try {
        const response = await fetch(apiUrl);
        const data = await response.json();

        // Update the weather card with fetched data
        document.getElementById('weather-icon').src = getWeatherImage(data.weather[0].icon);
        document.getElementById('weather-temp').textContent = `${data.main.temp}°C`;
        document.getElementById('weather-desc').textContent = data.weather[0].description;

        // Display humidity and wind on separate lines with reduced font size
        const humidityElement = document.getElementById('weather-humidity');
        humidityElement.innerHTML = `Humidity: ${data.main.humidity}%`;
        humidityElement.style.fontSize = '12px'; // Adjust font size as needed
        humidityElement.style.display = 'block'; // Ensure each piece of info is on a new line

        const windElement = document.getElementById('weather-wind');
        windElement.innerHTML = `Wind: ${data.wind.speed} km/h`;
        windElement.style.fontSize = '12px'; // Adjust font size as needed
        windElement.style.display = 'block'; // Ensure each piece of info is on a new line

        // Format date in the desired format: "Monday, 26 Aug 2024"
        const date = new Date(data.dt * 1000);
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        const formattedDate = date.toLocaleDateString('en-US', options);
        document.getElementById('weather-date').textContent = formattedDate;

        document.getElementById('weather-location').textContent = `${data.name}, ${data.sys.country}`;
    } catch (error) {
        console.error('Error fetching weather data:', error);
        document.getElementById('weather-temp').textContent = 'Error';
        document.getElementById('weather-desc').textContent = 'Unable to fetch data';
    }
}

// Function to get weather image based on weather icon code
function getWeatherImage(iconCode) {
    const iconMap = {
        '01d': 'https://cdn-icons-png.flaticon.com/128/4814/4814268.png',
        '01n': 'https://cdn-icons-png.flaticon.com/128/8030/8030068.png',
        '02d': 'https://cdn-icons-png.flaticon.com/128/3104/3104619.png',
        '02n': 'https://cdn-icons-png.flaticon.com/128/16141/16141717.png',
        '03d': 'https://cdn-icons-png.flaticon.com/128/414/414927.png',
        '03n': 'https://cdn-icons-png.flaticon.com/128/414/414927.png',
        '04d': 'https://cdn-icons-png.flaticon.com/128/414/414927.png',
        '04n': 'https://cdn-icons-png.flaticon.com/128/3845/3845731.png',
        '09d': 'https://cdn-icons-png.flaticon.com/128/3093/3093390.png',
        '09n': 'https://cdn-icons-png.flaticon.com/128/4735/4735072.png',
        '10d': 'https://cdn-icons-png.flaticon.com/128/4724/4724094.png',
        '10n': 'https://cdn-icons-png.flaticon.com/128/3937/3937259.png',
        '11d': 'https://cdn-icons-png.flaticon.com/128/3445/3445722.png',
        '11n': 'https://cdn-icons-png.flaticon.com/128/1146/1146799.png',
        '13d': 'https://cdn-icons-png.flaticon.com/128/642/642000.png',
        '13n': 'https://cdn-icons-png.flaticon.com/128/2480/2480636.png',
        '50d': 'https://cdn-icons-png.flaticon.com/128/2675/2675962.png',
        '50n': 'https://cdn-icons-png.flaticon.com/128/106/106052.png',
    };
    return iconMap[iconCode] || 'https://example.com/images/default.png';
}

// Function to get user's current location and fetch weather data
function getLocationAndFetchWeather() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            fetchWeather(lat, lon);
        }, error => {
            console.error('Error getting location:', error);
            document.getElementById('weather-temp').textContent = 'Error';
            document.getElementById('weather-desc').textContent = 'Unable to fetch location';
        });
    } else {
        console.error('Geolocation is not supported by this browser.');
        document.getElementById('weather-temp').textContent = 'Error';
        document.getElementById('weather-desc').textContent = 'Geolocation not supported';
    }
}

// Call the function to get location and fetch weather data when the page loads
window.onload = getLocationAndFetchWeather;
