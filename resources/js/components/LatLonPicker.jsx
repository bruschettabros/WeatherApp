import PropTypes from "prop-types";
import React, { useState } from 'react';
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";

function LatLonPicker(props) {
    return (
        <div className="col-md-6">
            <div className="card h-100">
                <div className="card-header">Select location</div>
                <div className="card-body">
                    <div>
                        <div className="input-group mb-3">
                            <div className="input-group-prepend">
                                <span className="input-group-text" id="lat-input">Lat</span>
                            </div>
                            <input
                                className={'form-control'}
                                value={props.lat}
                                onChange={(event) => props.setLat(event.target.value)}
                            />
                        </div>
                        <div className="input-group mb-3">
                            <div className="input-group-prepend">
                                <span className="input-group-text" id="lon-input">Lon</span>
                            </div>
                            <input
                                className={'form-control'}
                                value={props.lon}
                                onChange={(event) => props.setLon(event.target.value)}
                            />
                        </div>
                    </div>

                </div>
            </div>
        </div>
    );
}
LatLonPicker.propTypes = {
    lat: PropTypes.number.isRequired,
    lon: PropTypes.number.isRequired,
    setLat: PropTypes.func.isRequired,
    setLon: PropTypes.func.isRequired,
};

export default LatLonPicker;
