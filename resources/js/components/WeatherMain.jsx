
import React from 'react';
import ReactDOM from 'react-dom';
import Weather from './Weather.jsx';

// This is a functional component
const WeatherMain = () => {
    const [lat, setLat] = React.useState(50);
    const [lon, setLon] = React.useState(-1);
    const [date, setDate] = React.useState(null);

    return (
        <div>
        <Weather title={'Current Weather'} lat={lat} lon={lon}/>
        <Weather title={'Past Weather'} lat={lat} lon={lon}/>
        </div>
    )
}

const root = ReactDOM.createRoot(document.getElementById('weatherMain'));
root.render(<WeatherMain />);
