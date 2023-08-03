import React, { useEffect, useState } from 'react';
import WeatherData from './WeatherData.jsx';
import PropTypes from 'prop-types';

function Weather({ title, lat, lon, route = '/api/weather/current', additionalParams = [] }) {

    const [weather, setWeather] = useState([]);
    const [loading, setLoading] = useState(false);

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
    }, [lat, lon, additionalParams]);
    return (
        <div className="col-md-6">
            <div className="card h-100">
                <div className="card-header">{title}</div>
                <div className="card-body">
                    <div className="weatherData">
                        {loading
                            ? <div className="spinner-border" role="status">
                                <span className="sr-only"></span>
                            </div>
                            : <WeatherData data={weather} loading={loading} />}
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
};

export default Weather;
