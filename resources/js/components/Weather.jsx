import React, { useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import WeatherData from './WeatherData.jsx';
import PropTypes from 'prop-types';

function Weather({title, lat, lon, route = '/api/weather/current', additionalParams = []}) {

    const [weather, setWeather] = React.useState([]);
    const [loading, setLoading] = React.useState(false);

    useEffect(() => {
        setLoading(true);
        axios.get(route, {
            params: {
                lat: lat,
                lon: lon,
                ...additionalParams,
            },
        }).then(response => {
            setWeather(response.data);
            setLoading(false);
        });
    }, [lat, lon]);
    return (
        <div className="container mb-3">
            <div className="row justify-content-lg-end">
                <div className="col-md-6">
                    <div className="card">
                        <div className="card-header">{title}</div>
                        <div className="card-body">
                            <div className="weatherData">
                                <WeatherData data={weather} loading={loading} />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

Weather.propTypes = {
    title: PropTypes.string.isRequired,
    lat: PropTypes.number.isRequired,
    lon: PropTypes.number.isRequired,
    route: PropTypes.string.isRequired,
    additionalParams: PropTypes.array.isRequired,
};

export default Weather;
