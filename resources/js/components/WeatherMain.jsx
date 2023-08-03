import React, { useState } from 'react';
import ReactDOM from 'react-dom/client';
import Weather from './Weather.jsx';
import DatePicker from './DatePicker.jsx';
import LatLonPicker from './LatLonPicker.jsx';

// This is a functional component
const WeatherMain = () => {
    const [lat, setLat] = useState(50);
    const [lon, setLon] = useState(-1);

    const yesterday = new Date();
    yesterday.setDate(yesterday.getDate() - 1);
    const [date, setDate] = useState(yesterday);

    return (
        <div className="container">
            <div className="row justify-content-lg-end mb-3">
                <LatLonPicker
                    lat={lat}
                    lon={lon}
                    setLat={setLat}
                    setLon={setLon}
                />
                <Weather
                    title={'Current Weather'}
                    lat={lat}
                    lon={lon}
                    additionalParams={null}
                />
            </div>
            <div className="row justify-content-lg-end">
                <DatePicker
                    date={date}
                    setDate={setDate}
                />
                <Weather
                    title={'Past Weather'}
                    lat={lat}
                    lon={lon}
                    route={'/api/weather/past'}
                    additionalParams={{
                        date: date.toLocaleDateString(),
                }}
                />
            </div>
        </div>
    )
}

const root = ReactDOM.createRoot(document.getElementById('weatherMain'));
root.render(<WeatherMain />);
