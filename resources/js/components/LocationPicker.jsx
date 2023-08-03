import PropTypes from 'prop-types';
import React, { useCallback, useEffect, useRef, useState } from 'react';
import { GoogleMap, useJsApiLoader } from '@react-google-maps/api';
import GoogleMapReact from 'google-map-react';

function LocationPin(props) {
    return null;
}

LocationPin.propTypes = { lat: PropTypes.number };

function LocationPicker(props) {
    const center = {
        lat: props.lat,
        lng: props.lon,
    };

    const containerStyle = {
        width: '500px',
        height: '420px',
    };

    const [map, setMap] = useState(null);

    const onLoad = useCallback(function callback(map) {
        const bounds = new window.google.maps.LatLngBounds(center);
        map.fitBounds(bounds);
        console.log(map);
        setMap(map);
    }, []);

    const onUnmount = useCallback(function callback(map) {
        setMap(null);
    }, []);

    useEffect(() => {
        props.setLat(center.lat);
        props.setLon(center.lng);
    }, [center]);

    return (
        <div className="col-md-6">
            <div className="card">
                <div className="card-header">Location Picker</div>
                <div className="card-body">
                    <GoogleMapReact
                        bootstrapURLKeys={{ key: 'AIzaSyDo_khp7LFtQtFxNRJyyx9phTpYeHxgt4k' }}
                        defaultCenter={center}
                        defaultZoom={10}
                    >
                        <LocationPin
                            lat={props.lat}
                            lng={props.lon}
                        />
                    </GoogleMapReact>
                </div>
            </div>
        </div>
    );
}

LocationPicker.propTypes = {
    lat: PropTypes.number.isRequired,
    lon: PropTypes.number.isRequired,
    setLat: PropTypes.func.isRequired,
    setLon: PropTypes.func.isRequired,
};

export default LocationPicker;
