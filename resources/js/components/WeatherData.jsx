import PropTypes from 'prop-types';

function WeatherData(props) {
    return props.data.map((item, index) => {
        console.log(item);
        return (
            <div key={index}>
                <div className="row">
                    <p>Temperature: {item.temperature}</p>
                    <p>Humidity: {item.humidity}</p>
                    <p>Raining: {item.raining}</p>
                    <p>Snowing: {item.snowing}</p>
                    <p>Pressure: {item.pressure}</p>
                    <p>Visibility: {item.visibility}</p>
                    <p>Wind speed: {item['wind speed']}</p>
                </div>
            </div>
        );
    });
}

WeatherData.propTypes = {
    data: PropTypes.array.isRequired,
    loading: PropTypes.bool.isRequired,
};

export default WeatherData;
