import PropTypes from 'prop-types';
import React, { useEffect } from 'react';
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
                        bootstrapURLKeys={{ key: import.meta.env.MAPS_API_KEY }}
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
